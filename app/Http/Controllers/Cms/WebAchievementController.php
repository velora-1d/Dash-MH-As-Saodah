<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\WebAchievement;
use Illuminate\Http\Request;

class WebAchievementController extends Controller
{
    public function index()
    {
        $achievements = WebAchievement::orderByDesc('year')->get();
        return view('cms.achievements.index', compact('achievements'));
    }

    public function create() { return view('cms.achievements.create'); }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'competition_name' => 'nullable|string|max:255',
            'level' => 'required|in:internasional,nasional,provinsi,kabupaten,kecamatan,lainnya',
            'student_name' => 'nullable|string|max:255',
            'year' => 'required|digits:4',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only(['title', 'competition_name', 'level', 'student_name', 'year']);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('web-achievements', 'public');
        }

        WebAchievement::create($data);
        return redirect()->route('cms.achievements.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function edit(WebAchievement $achievement) { return view('cms.achievements.edit', compact('achievement')); }

    public function update(Request $request, WebAchievement $achievement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'competition_name' => 'nullable|string|max:255',
            'level' => 'required|in:internasional,nasional,provinsi,kabupaten,kecamatan,lainnya',
            'student_name' => 'nullable|string|max:255',
            'year' => 'required|digits:4',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only(['title', 'competition_name', 'level', 'student_name', 'year']);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('web-achievements', 'public');
        }

        $achievement->update($data);
        return redirect()->route('cms.achievements.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy(WebAchievement $achievement)
    {
        $achievement->delete();
        return redirect()->route('cms.achievements.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}
