<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('shops')->insert([
             'id' => '1',
             'name'=>'武蔵家　東名川崎店',
             'reserve'=>'不可',
             'menu' => 'ラーメン、チャーシューメン、
                        のりチャーシュー',
             'open_time'=>'11:00',
             'close_time'=>'23:00',
             'phone'=>'044-977-0090',
             'min_price'=>'1000',
             'max_price'=>'1500',
             'created_at'=>new DateTime(),
             'updated_at'=>new DateTime(),
             'review_avg'=>'4',
             'location_id'=>'1',
             'shop_category_id'=>'4',
             'user_id'=>'1',
             'shop_image_url' => 'https://res.cloudinary.com/dpebybx0r/image/upload/v1726591093/musashiya-ramen-classic-768x1024_vo3xnx.webp'
        ]);
        
        DB::table('shops')->insert([
             'id'=>'2',
             'name'=>'ラーメン大桜　川崎野川店',
             'reserve'=>'不可',
             'open_time'=>'11:00',
             'close_time'=>'22:00',
             'menu' => 'らぁめん、チャーシューめん、ザクピリ',
             'phone'=>'044-863-7326',
             'min_price'=>'800',
             'max_price'=>'1500',
             'created_at'=>new DateTime(),
             'updated_at'=>new DateTime(),
             'review_avg'=>'3',
             'location_id'=>'2',
             'shop_category_id'=>'4',
             'user_id'=>'1',
            'shop_image_url' => 'https://res.cloudinary.com/dpebybx0r/image/upload/v1726591069/640x640_rect_d712268dbc880c4bbf277f8e49c09f25_lf9jvi.jpg',
        ]);
        
        DB::table('shops')->insert([
             'id'=>'3',
             'name'=>'京都北白川ラーメン魁力屋 宮前店',
             'reserve'=>'不可',
             'open_time'=>'11:00',
             'close_time'=>'23:00',
             'menu' => '特製醤油九条ねぎラーメン、コク旨辛ネギラーメン、から味噌ラーメン、
                        コク旨ラーメン',
             'phone'=>'0449821539',
             'min_price'=>'1000',
             'max_price'=>'2000',
             'created_at'=>new DateTime(),
             'updated_at'=>new DateTime(),
             'review_avg'=>'2',
             'location_id'=>'3',
             'shop_category_id'=>'4',
             'user_id'=>'1',
            'shop_image_url' => 'https://res.cloudinary.com/dpebybx0r/image/upload/v1726591060/640x640_rect_bc2577bb9a2f46d2fb07bb16c574f71a_wkblan.jpg',
        ]);
        
        DB::table('shops')->insert([
             'id'=>'4',
             'name'=>'新世 宮前店',
             'reserve'=>'不可',
             'open_time'=>'11:00',
             'close_time'=>'23:00',
             'menu' => 'ラーメン、にんにくラーメン、味噌ラーメン、キャベツラーメン、炒飯',
             'phone'=>'0448206298',
             'min_price'=>'1000',
             'max_price'=>'2000',
             'created_at'=>new DateTime(),
             'updated_at'=>new DateTime(),
             'review_avg'=>'1',
             'location_id'=>'4',
             'shop_category_id'=>'4',
             'user_id'=>'1',
            'shop_image_url' => 'https://res.cloudinary.com/dpebybx0r/image/upload/v1726591101/P017777481_480_rjqje2.jpg',
        ]);
        
        DB::table('shops')->insert([
             'id'=>'5',
             'name'=>'優しい中華 柊 ひいらぎ',
             'reserve'=>'可',
             'open_time'=>'11:30',
             'close_time'=>'23:00',
             'menu' => '担々麵、その他定食',
             'phone'=>'0447676301',
             'min_price'=>'900',
             'max_price'=>'1500',
             'created_at'=>new DateTime(),
             'updated_at'=>new DateTime(),
             'review_avg'=>'5',
             'location_id'=>'5',
             'shop_category_id'=>'1',
             'user_id'=>'1',
            'shop_image_url' => 'https://res.cloudinary.com/dpebybx0r/image/upload/v1726591608/o0325027715220088421_uet8fb.jpg',
        ]);
    }
}
