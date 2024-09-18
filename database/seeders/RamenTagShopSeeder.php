<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RamenTagShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ramen_tag_shop')->insert([
            'shop_id' => '1',
            'ramen_tag_id' => '4',
        ]);
        
        DB::table('ramen_tag_shop')->insert([
            ['shop_id' => 2, 'ramen_tag_id' => 4],
        ]);
        
        DB::table('ramen_tag_shop')->insert([
            ['shop_id' => 3, 'ramen_tag_id' => 1],
            ['shop_id' => 3, 'ramen_tag_id' => 2],
            ['shop_id' => 3, 'ramen_tag_id' => 3],
            ['shop_id' => 3, 'ramen_tag_id' => 4],
        ]);
        
        DB::table('ramen_tag_shop')->insert([
            ['shop_id' => 4, 'ramen_tag_id' => 4],    
        ]);
        
        DB::table('ramen_tag_shop')->insert([
            ['shop_id' => 5, 'ramen_tag_id' => 7], 
        ]);
    }
}
