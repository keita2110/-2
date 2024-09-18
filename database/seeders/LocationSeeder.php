<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            'address'=>'神奈川県川崎市宮前区犬蔵1-9-14',
            'latitude'=>'35.58777599',
            'longitude'=>'139.563724795',
        ]);
        
        DB::table('locations')->insert([
            'address'=>'神奈川県川崎市宮前区南野川2-1-25',
            'latitude'=>'35.566853807465',
            'longitude'=>'139.601370225',
        ]);
        
        DB::table('locations')->insert([
            'address'=>'〒216-0002 神奈川県川崎市宮前区東有馬５丁目５−１',
            'latitude'=>'35.57104474453756',
            'longitude'=>'139.59272448768192',
        ]);
        
        DB::table('locations')->insert([
            'address'=>'〒216-0003 神奈川県川崎市宮前区有馬２丁目８−１',
            'latitude'=>'35.57984593079752',
            'longitude'=>'139.58466978850686',
        ]);
        
        DB::table('locations')->insert([
            'address'=>'〒216-0002 神奈川県川崎市宮前区東有馬３丁目８−２７ レスターテ鷺沼',
            'latitude'=>'35.57171958794088',
            'longitude'=>'139.58819207796392',
        ]);
    }
}
