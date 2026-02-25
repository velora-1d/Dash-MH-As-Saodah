<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\WebTeacher;
use Illuminate\Http\Request;

class WebTeacherController extends Controller
{
    public function index()
    {
        $teachers = WebTeacher::orderBy('order')->get();
        return view('cms.teachers.index', compact('teachers'));
    }

    public function create() { return view('cms.teachers.create'); }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only(['name', 'position', 'bio']);
        $data['is_visible'] = $request->boolean('is_visible', true);
        $data['order'] = WebTeacher::max('order') + 1;

        if ($request->hasFile('photo')) {
            $data['photo_url'] = $request->file('photo')->store('web-teachers', 'public');
        }

        WebTeacher::create($data);
        return redirect()->route('cms.teachers.index')->with('success', 'Profil guru berhasil ditambahkan.');
    }

    public function edit(WebTeacher $teacher) { return view('cms.teachers.edit', compact('teacher')); }

    public function update(Request $request, WebTeacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only(['name', 'position', 'bio']);
        $data['is_visible'] = $request->boolean('is_visible', true);

        if ($request->hasFile('photo')) {
            $data['photo_url'] = $request->file('photo')->store('web-teachers', 'public');
        }

        $teacher->update($data);
        return redirect()->route('cms.teachers.index')->with('success', 'Profil guru berhasil diperbarui.');
    }

    public function destroy(WebTeacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('cms.teachers.index')->with('success', 'Profil guru berhasil dihapus.');
    }
}
