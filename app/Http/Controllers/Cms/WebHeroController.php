<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\WebHero;
use Illuminate\Http\Request;

class WebHeroController extends Controller
{
    public function index()
    {
        $heroes = WebHero::orderBy('order')->get();
        return view('cms.heroes.index', compact('heroes'));
    }

    public function create()
    {
        return view('cms.heroes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'media' => 'required|file|mimes:jpg,jpeg,png,webp,mp4|max:20480',
            'cta_text' => 'nullable|string|max:255',
            'cta_url' => 'nullable|string|max:255',
        ]);

        $file = $request->file('media');
        $path = $file->store('web-heroes', 'public');
        $mediaType = str_starts_with($file->getMimeType(), 'video') ? 'video' : 'image';

        WebHero::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'media_url' => $path,
            'media_type' => $mediaType,
            'cta_text' => $request->cta_text,
            'cta_url' => $request->cta_url,
            'is_active' => $request->boolean('is_active', true),
            'order' => WebHero::max('order') + 1,
        ]);

        return redirect()->route('cms.heroes.index')
            ->with('success', 'Slider Hero berhasil ditambahkan.');
    }

    public function edit(WebHero $hero)
    {
        return view('cms.heroes.edit', compact('hero'));
    }

    public function update(Request $request, WebHero $hero)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4|max:20480',
            'cta_text' => 'nullable|string|max:255',
            'cta_url' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['title', 'subtitle', 'cta_text', 'cta_url']);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $data['media_url'] = $file->store('web-heroes', 'public');
            $data['media_type'] = str_starts_with($file->getMimeType(), 'video') ? 'video' : 'image';
        }

        $hero->update($data);

        return redirect()->route('cms.heroes.index')
            ->with('success', 'Slider Hero berhasil diperbarui.');
    }

    public function destroy(WebHero $hero)
    {
        $hero->delete();
        return redirect()->route('cms.heroes.index')
            ->with('success', 'Slider Hero berhasil dihapus.');
    }
}
