<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\WebSetting;
use Illuminate\Http\Request;

class WebSettingController extends Controller
{
    public function index()
    {
        $settings = WebSetting::all()->groupBy('group');
        return view('cms.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token', '_method') as $key => $value) {
            // Handle file uploads
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $path = $file->store('web-settings', 'public');
                WebSetting::setValue($key, $path);
            } else {
                WebSetting::setValue($key, $value);
            }
        }

        return redirect()->route('cms.settings.index')
            ->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}
