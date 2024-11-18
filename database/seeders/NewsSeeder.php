<?php

namespace Database\Seeders;

// database/seeders/NewsSeeder.php
use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run()
    {
        News::create(['title' => 'ニュース1', 'content' => 'これは最初のニュースです。']);
        News::create(['title' => 'ニュース2', 'content' => 'これは2番目のニュースです。']);
    }
}
