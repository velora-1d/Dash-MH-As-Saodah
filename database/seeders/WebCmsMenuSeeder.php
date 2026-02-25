<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class WebCmsMenuSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus menu CMS lama jika ada
        Menu::where('group_name', 'CMS Website')->delete();

        // Cari order_index tertinggi untuk menempatkan di bawah
        $maxOrder = Menu::max('order_index') ?? 0;
        $startOrder = $maxOrder + 1;

        // 1. Buat menu INDUK "CMS Website"
        $parent = Menu::updateOrCreate(
            ['route_name' => 'cms.settings.index'],
            [
                'name' => 'CMS Website',
                'route_name' => 'cms.settings.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />',
                'group_name' => 'CMS Website',
                'roles' => ['superadmin', 'kepsek', 'admin'],
                'order_index' => $startOrder,
                'parent_id' => null,
                'is_active' => true,
            ]
        );

        // 2. Buat sub-menu (children)
        $children = [
            [
                'name' => 'Pengaturan Web',
                'route_name' => 'cms.settings.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />',
                'order_index' => 1,
            ],
            [
                'name' => 'Hero / Slider',
                'route_name' => 'cms.heroes.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />',
                'order_index' => 2,
            ],
            [
                'name' => 'Fasilitas',
                'route_name' => 'cms.facilities.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />',
                'order_index' => 3,
            ],
            [
                'name' => 'Prestasi',
                'route_name' => 'cms.achievements.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />',
                'order_index' => 4,
            ],
            [
                'name' => 'Berita & Artikel',
                'route_name' => 'cms.posts.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />',
                'order_index' => 5,
            ],
            [
                'name' => 'Profil Guru',
                'route_name' => 'cms.teachers.index',
                'icon_svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />',
                'order_index' => 6,
            ],
        ];

        foreach ($children as $child) {
            Menu::updateOrCreate(
                ['route_name' => $child['route_name'], 'parent_id' => $parent->id],
                array_merge($child, [
                    'parent_id' => $parent->id,
                    'group_name' => 'CMS Website',
                    'roles' => ['superadmin', 'kepsek', 'admin'],
                    'is_active' => true,
                ])
            );
        }

        // Hapus duplikat menu level-atas yang sekarang sudah jadi child
        // (menu lama tanpa parent_id, kecuali parent itu sendiri)
        Menu::where('group_name', 'CMS Website')
            ->whereNull('parent_id')
            ->where('id', '!=', $parent->id)
            ->delete();
    }
}
