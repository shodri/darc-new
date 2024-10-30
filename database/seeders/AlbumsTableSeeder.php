<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Album;
class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $albums = [
            [
                'title' => 'Banners home',
                'description' => 'Imágenes del carousel principal',
                'section' => 'home',
                'type' => 'carousel',
                'height' => 670,
                'width' => 1600,
            ]
        ];

        foreach ($albums as $album) {
            Album::create($album);
        }
    }
}
