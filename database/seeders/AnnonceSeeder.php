<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnonceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('annonces')->insert([
            'date_publication' => '2024-03-02 12:00:00',
            'image' => 'C:\Users\DELL\AppData\Local\Temp\e28a9261b284f3f7eca2736cbd97b021.png',
            'description' => 'Architecto qui distinctio repellat aliquam velit vel. Eum et et non impedit deleniti temporibus possimus. Facere inventore rerum et.',
            'video' => 'C:\Users\DELL\Videos\vid_ess',
            'bien_id' => 2,
        ]);

        DB::table('annonces')->insert([
            'date_publication' => '2023-11-25 00:00:00',
            'image' => 'C:\Users\DELL\AppData\Local\Temp\e28a9261b284f3f7eca2736cbd97b021.png',
            'description' => 'Architecto qui distinctio repellat aliquam velit vel. Eum et et non impedit deleniti temporibus possimus. Facere inventore rerum et.',
            'video' => 'C:\Users\DELL\Videos\vid_ess',
            'bien_id' => 3,
        ]);
    }
}
