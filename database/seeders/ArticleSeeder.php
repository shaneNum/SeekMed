<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Manfaat Konsultasi Medis Online',
                'slug' => Str::slug('Manfaat Konsultasi Medis Online'),
                'excerpt' => 'Konsultasi online memungkinkan pasien mendapat akses cepat ke dokter...',
                'body' => 'Ini adalah artikel panjang mengenai manfaat konsultasi online...',
                'author' => 'Admin',
            ],
            [
                'title' => 'Cara Menjaga Kesehatan di Musim Hujan',
                'slug' => Str::slug('Cara Menjaga Kesehatan di Musim Hujan'),
                'excerpt' => 'Musim hujan membawa risiko demam dan flu...',
                'body' => 'Artikel lengkap tentang cara menjaga kesehatan saat musim hujan...',
                'author' => 'Admin',
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
