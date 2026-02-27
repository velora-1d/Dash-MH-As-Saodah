<?php

namespace App\Http\Controllers;

use App\Models\RegistrationPayment;
use Illuminate\Http\Request;

class QuickPaymentController extends Controller
{
    /**
     * Toggle status boolean pada RegistrationPayment via AJAX.
     */
    public function toggle(Request $request, RegistrationPayment $registrationPayment)
    {
        $request->validate([
            'field' => 'required|in:is_fee_paid,is_books_paid,is_books_received,is_uniform_paid,is_uniform_received',
            'amount' => 'nullable|numeric|min:0',
        ]);

        $field = $request->field;
        $newValue = !$registrationPayment->{$field};

        // Determine amounts and setting keys
        $amountField = null;
        $settingKey = null;

        if ($field === 'is_fee_paid') {
            $amountField = 'fee_amount';
            if ($registrationPayment->registrationable_type === \App\Models\PpdbRegistration::class) {
                $settingKey = 'ppdb_registration_fee';
            } else {
                $settingKey = 're_registration_fee';
            }
        } elseif ($field === 'is_books_paid') {
            $amountField = 'books_amount';
            $settingKey = 'books_fee';
        } elseif ($field === 'is_uniform_paid') {
            $amountField = 'uniform_amount';
            $settingKey = 'uniform_fee';
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($field, $newValue, $registrationPayment, $amountField, $settingKey, $request) {
            
            // Generate unique description modifier reference to identify the transaction
            $refSource = "REF:REGPAY_" . $registrationPayment->id . "_" . $field;

            if ($newValue) {
                // TOGGLE ON -> MENCATAT PEMASUKAN

                // Jika ada field nominal
                if ($amountField) {
                    // Pakai nominal spesifik yang diinput user atau kembalikan ke default jika kosong
                    $nominal = (float) $request->input('amount', \App\Models\WebSetting::getValue($settingKey, 0));
                    
                    // Simpan nominal ke record pembayaran
                    $registrationPayment->{$amountField} = $nominal;

                    if ($nominal > 0) {
                        // Cari Kas Tunai (Atau Default Kas ID: 2)
                        $cashAccount = \App\Models\CashAccount::find(2) ?? \App\Models\CashAccount::first();
                        
                        // Buat atau cari kategori Pendaftaran
                        $category = \App\Models\TransactionCategory::firstOrCreate(
                            ['name' => 'Pendaftaran / Daftar Ulang'],
                            ['type' => 'in', 'description' => 'Penerimaan otomatis dari menu pendaftaran']
                        );

                        if ($cashAccount) {
                            $studentName = $registrationPayment->registrationable->student_name ?? 'Siswa (ID:' . $registrationPayment->registrationable_id . ')';
                            
                            $descText = "Penerimaan ";
                            if ($field === 'is_fee_paid') $descText .= "Biaya Pendaftaran";
                            elseif ($field === 'is_books_paid') $descText .= "Biaya LKS";
                            elseif ($field === 'is_uniform_paid') $descText .= "Biaya Seragam";

                            // Tambah konteks PPDB atau Daftar Ulang
                            $contextLabel = '';
                            if ($registrationPayment->registrationable_type === \App\Models\PpdbRegistration::class) {
                                $contextLabel = 'PPDB';
                            } else {
                                $contextLabel = 'Daftar Ulang';
                            }

                            // Format user-friendly: "Penerimaan Biaya Pendaftaran - Nama Siswa (Daftar Ulang)"
                            // REF ID tetap disimpan di akhir untuk kebutuhan void/lookup
                            $displayDesc = $descText . " - " . $studentName . " (" . $contextLabel . ")";
                            $refTag = " [ref:" . $registrationPayment->id . "_" . $field . "]";

                            \App\Models\GeneralTransaction::create([
                                'category_id' => $category->id,
                                'cash_account_id' => $cashAccount->id,
                                'user_id' => \Illuminate\Support\Facades\Auth::id() ?? 1,
                                'type' => 'in',
                                'amount' => $nominal,
                                'date' => now(),
                                'description' => $displayDesc . $refTag,
                                'status' => 'valid',
                            ]);

                            $cashAccount->increment('balance', $nominal);
                        }
                    }
                }
            } else {
                // TOGGLE OFF -> MENGHAPUS PEMASUKAN / VOID
                
                if ($amountField) {
                    $registrationPayment->{$amountField} = 0;

                    // Cari transaksi dengan ref khusus (format baru: [ref:X_field] atau format lama: REF:REGPAY_X_field)
                    $refNew = "[ref:" . $registrationPayment->id . "_" . $field . "]";
                    $transactions = \App\Models\GeneralTransaction::where(function($q) use ($refSource, $refNew) {
                            $q->where('description', 'like', "%{$refSource}")
                              ->orWhere('description', 'like', "%{$refSource} (DIBATALKAN)")
                              ->orWhere('description', 'like', "%{$refNew}%");
                        })
                        ->where('status', 'valid')
                        ->get();

                    /** @var \App\Models\GeneralTransaction $txn */
                    foreach ($transactions as $txn) {
                        $cashAccount = \App\Models\CashAccount::find($txn->cash_account_id);
                        if ($cashAccount) {
                            $cashAccount->decrement('balance', (float) $txn->amount);
                        }
                        $txn->update(['status' => 'void', 'description' => $txn->description . ' (DIBATALKAN)']);
                    }
                }
            }

            $registrationPayment->{$field} = $newValue;
            $registrationPayment->save();
        });

        return response()->json([
            'success' => true,
            'field' => $field,
            'value' => $newValue,
        ]);
    }
}
