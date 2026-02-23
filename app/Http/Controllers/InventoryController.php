<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * Menampilkan daftar Inventaris.
     */
    public function index(Request $request)
    {
        $query = Inventory::query();

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('item_code', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Filter berdasar Kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter Kondisi (Baik, Rusak Ringan, Rusak Berat)
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        $inventories = $query->orderBy('name', 'asc')->paginate(15)->withQueryString();
        
        // Setup List kategori unik bagi filter Dropdown
        $categories = Inventory::select('category')->distinct()->pluck('category');

        return view('inventory.index', compact('inventories', 'categories'));
    }

    /**
     * Menampilkan form Tambah Stok/Aset.
     */
    public function create()
    {
        return view('inventory.create');
    }

    /**
     * Menyimpan Aset Awal & Mencatat Log Mutasi Masuk.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_code'    => 'nullable|string|unique:inventories,item_code',
            'name'         => 'required|string|max:255',
            'category'     => 'required|string|max:100',
            'location'     => 'nullable|string|max:255',
            'quantity'     => 'required|integer|min:1',
            'condition'    => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'unit_price'   => 'nullable|numeric|min:0',
            'acquire_date' => 'nullable|date',
            'notes'        => 'nullable|string',
        ]);

        $inventory = Inventory::create($validated);

        // Rekam Jejak
        InventoryLog::create([
            'inventory_id'   => $inventory->id,
            'action_type'    => 'stok_masuk',
            'previous_value' => '0',
            'new_value'      => (string)$inventory->quantity,
            'description'    => 'Pendataan awal aset/barang baru.',
            'user_id'        => Auth::id(),
        ]);

        return redirect()->route('inventory.index')->with('success', 'Data aset berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit spesifikasi aset.
     */
    public function edit(Inventory $inventory)
    {
        return view('inventory.edit', compact('inventory'));
    }

    /**
     * Memperbarui detail barang & mencatat log hanya jika ada perubahan kuantitas/kondisi.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'item_code'    => 'nullable|string|unique:inventories,item_code,' . $inventory->id,
            'name'         => 'required|string|max:255',
            'category'     => 'required|string|max:100',
            'location'     => 'nullable|string|max:255',
            'quantity'     => 'required|integer|min:0',
            'condition'    => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'unit_price'   => 'nullable|numeric|min:0',
            'acquire_date' => 'nullable|date',
            'notes'        => 'nullable|string',
        ]);

        $oldQty = $inventory->quantity;
        $oldCond = $inventory->condition;

        $inventory->update($validated);

        // Pencatatan Log Dinamis apabila Stok berubah Mutasi Keluar / Masuk
        if ($oldQty !== $inventory->quantity) {
            InventoryLog::create([
                'inventory_id'   => $inventory->id,
                'action_type'    => $inventory->quantity > $oldQty ? 'stok_masuk' : 'stok_keluar',
                'previous_value' => (string)$oldQty,
                'new_value'      => (string)$inventory->quantity,
                'description'    => 'Penyesuaian kuantitas jumlah stok fisik.',
                'user_id'        => Auth::id(),
            ]);
        }

        // Pencatatan Log apabila Kondisi (Aus/Rusak) Berubah
        if ($oldCond !== $inventory->condition) {
            InventoryLog::create([
                'inventory_id'   => $inventory->id,
                'action_type'    => 'ubah_kondisi',
                'previous_value' => $oldCond,
                'new_value'      => $inventory->condition,
                'description'    => 'Status kondisi fisik barang diubah.',
                'user_id'        => Auth::id(),
            ]);
        }

        return redirect()->route('inventory.index')->with('success', 'Data spesifikasi aset berhasil diperbarui!');
    }

    /**
     * Menghapus (Soft Delete / Write-off) aset rusak dari sirkulasi aktif.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        InventoryLog::create([
            'inventory_id'   => $inventory->id,
            'action_type'    => 'hapus_aset',
            'previous_value' => null,
            'new_value'      => 'Soft Deleted',
            'description'    => 'Penghapusan (Write-off) aset dari sirkulasi.',
            'user_id'        => Auth::id(),
        ]);

        return redirect()->route('inventory.index')->with('success', 'Aset telah dikeluarkan (dihapus) dari sirkulasi.');
    }
}
