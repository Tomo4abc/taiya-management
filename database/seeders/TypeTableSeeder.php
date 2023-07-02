<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create(['type_name' => 'ノーマルタイヤ']);
        Type::create(['type_name' => '冬用タイヤ']);
    }
}
