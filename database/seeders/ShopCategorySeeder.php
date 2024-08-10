<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ShopCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shop_categories')->insert([
            'name'=>'家系'
        ]);
        
        DB::table('shop_categories')->insert([
            'name'=>'二郎'
        ]);
        
        DB::table('shop_categories')->insert([
            'name'=>'二郎系'
        ]);
    }
}
