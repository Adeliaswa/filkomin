<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Template;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); 
        Template::truncate();

        Template::create([
            'name' => 'Default Simple Template',
            'description' => 'Template dasar untuk undangan resmi.',
            'path' => 'templates.default-simple', 
            'blade_view_name' => 'templates.default-simple',
        ]);
        
        Template::create([
            'name' => 'Premium Modern Template',
            'description' => 'Template modern dengan desain minimalis.',
            'path' => 'templates.premium-modern', 
            'blade_view_name' => 'templates.premium-modern',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
