<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('order_index')->get();
        return view('settings.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('settings.menus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'route_name' => 'required|string|max:255',
            'icon_svg' => 'required|string',
            'roles' => 'required|array',
            'order_index' => 'required|integer',
            'group_name' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Menu::create($validated);

        return redirect()->route('settings.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        return view('settings.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'route_name' => 'required|string|max:255',
            'icon_svg' => 'required|string',
            'roles' => 'required|array',
            'order_index' => 'required|integer',
            'group_name' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $menu->update($validated);

        return redirect()->route('settings.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('settings.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}
