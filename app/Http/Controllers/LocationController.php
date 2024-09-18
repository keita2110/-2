<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Shop;
use App\Models\ShopCategory;

class LocationController extends Controller
{
    public function search(Request $request) {
        $locations = Location::with(['shops.shop_category'])->get(); // 全ての場所とそのショップ、ショップカテゴリを取得

        $api_key = config('app.api_key');
        
        return view('locations.search')->with([
            'api_key' => $api_key,
            'locations' => $locations,
        ]);
    }
    
    public function getNearRamen(Request $request) {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
    
        $ramens = Location::select('subquery.*')
            ->fromSub(function ($query) use ($latitude, $longitude) {
                $query->select('locations.*')
                    ->selectRaw('(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance', [$latitude, $longitude, $latitude])
                    ->from('locations');
            }, 'subquery')
            ->where('subquery.distance', '<', 100)
            ->orderBy('subquery.distance')
            ->limit(5)
            ->with(['shops' => function($query) {
                $query->select('id', 'location_id', 'name', 'open_time', 'close_time', 'min_price', 'max_price', 'review_avg','shop_category_id')
                      ->with('shop_category')->get();
            }])
            ->get();
        
        $result = $ramens->map(function($ramen) {
            return [
                'latitude' => $ramen->latitude,
                'longitude' => $ramen->longitude,
                'distance' => $ramen->distance, 
                'address' => $ramen->address,
                'shops' => $ramen->shops->map(function($shop) {
                    return [
                        'id' => $shop->id,
                        'name' => $shop->name,
                        'open_time' => $shop->open_time,
                        'close_time' => $shop->close_time,
                        'min_price' => $shop->min_price,
                        'max_price' => $shop->max_price,
                        'review_avg' => $shop->review_avg,
                        'category_name' => $shop->shop_category ? $shop->shop_category->name : '未分類',
                    ];
                }),
            ];
        });
    
        return response()->json($result);
    }
}
