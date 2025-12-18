<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Template;

class TemplateSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Template::truncate();

        Template::create([
            'title' => 'Default Simple Template',
            'description' => 'Template dasar untuk undangan resmi.',
            'path' => 'templates.default-simple',
            'category' => 'formal',
        ]);

        Template::create([
            'title' => 'Premium Modern Template',
            'description' => 'Template modern dengan desain minimalis.',
            'path' => 'templates.premium-modern',
            'category' => 'modern',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
