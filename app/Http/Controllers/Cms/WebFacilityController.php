<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\WebFacility;
use Illuminate\Http\Request;

class WebFacilityController extends Controller
{
    public function index()
    {
        $facilities = WebFacility::orderBy('order')->get();
        return view('cms.facilities.index', compact('facilities'));
    }

    public function create() { return view('cms.facilities.create'); }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only(['name', 'description', 'icon_svg']);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['order'] = WebFacility::max('order') + 1;

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('web-facilities', 'public');
        }

        WebFacility::create($data);
        return redirect()->route('cms.facilities.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(WebFacility $facility) { return view('cms.facilities.edit', compact('facility')); }

    public function update(Request $request, WebFacility $facility)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only(['name', 'description', 'icon_svg']);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('web-facilities', 'public');
        }

        $facility->update($data);
        return redirect()->route('cms.facilities.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(WebFacility $facility)
    {
        $facility->delete();
        return redirect()->route('cms.facilities.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}
