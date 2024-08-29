<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Shop;

class LocationController extends Controller
{
    public function search() {
        $locations = Location::all();
        $api_key = config('app.api_key');
        
        return view('locations.search')->with([
            'api_key' => $api_key,
            'locations' => $locations,
        ]);
    }
    
    public function getNearRamen(Request $request) {
        $latitude = $request->input('latitude'); // ユーザから送信された緯度
        $longitude = $request->input('longitude'); // ユーザから送信された経度
        
        // ハバード距離を使用して、指定の位置から近い順に並べる
        $ramens = Location::with('shops') // shopsリレーションをロード
            ->selectRaw('locations.*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance', [$latitude, $longitude, $latitude])
            ->having('distance', '<', 5) // 5km以内
            ->orderBy('distance') // 距離の近い順
            ->limit(4) // 最大4件
            ->get(); // 結果の取得
        
        $result = $ramens->map(function($ramen) {
            return [
                'latitude' => $ramen->latitude,
                'longitude' => $ramen->longitude,
                'distance' => $ramen->distance,
                'shops' => $ramen->shops->map(function($shop) {
                    return [ // Shop の名前を取得
                        'id' => $shop->id,
                        'name' => $shop->name,
                    ];
                }),
            ];
        });
        // JSON形式で結果を返す
        return response()->json($ramens); 
    }
}
