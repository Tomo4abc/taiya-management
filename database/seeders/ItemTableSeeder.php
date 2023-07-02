<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            ['name' => 'ノーマルタイヤ'],
            ['name' => '冬用タイヤ'],
        ]);
    }
}
