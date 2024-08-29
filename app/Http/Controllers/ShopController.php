<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\RamenTag;
use App\Models\Review;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\ShopRequest;
use Cloudinary;
use App\Services\GeocodingService;

class ShopController extends Controller
{
    protected $geocodingService;
    
    public function __construct(GeocodingService $geocodingService){
        $this->geocodingService = $geocodingService;
    }
    
    public function index()
    {
        return view('shops.index');//->with(['shops' => $shop->get()]);
    }
    
    public function show(Shop $shop){
        $shop->load(['shop_category','ramen_tags','reviews.user','location']);
        // レビュー平均を更新
        $shop->updateReviewAvg();
        return view('shops.show')->with(['shop' => $shop]);
    }
    
    public function showEdit(Shop $shop){
        $shop->load(['shop_category','ramen_tags','reviews','location']);
        // レビュー平均を更新
        $shop->updateReviewAvg();
        return view('shops.showEdit',['shop' => $shop]);
    }
    
    public function edit(Shop $shop, ShopCategory $shopcategory, RamenTag $ramentag, Review $review){
        return view('shops.edit',[
            'shop' => $shop,
            'categories' => $shopcategory->get(),
            'tags' => $ramentag->get(),
            'reviews' => $review->all(),
        ]);
    }
    
    public function update(ShopRequest $request, Shop $shop) {
        $input = $request->input('shop');
        
        $locationAddress = $request->input('shop.location');
        $location = null;
        
        if($locationAddress){
            $coordinates = $this->geocodingService->getCoordinates($locationAddress);
            //あたらしいLocationインスタンスを作成し、保存
            if($coordinates) {
                $location = Location::create([
                    'address' => $locationAddress,
                    'latitude' => $coordinates['latitude'],
                    'longitude' => $coordinates['longitude'],
                ]);
            } else {
                $location = Location::create([
                    'address' => $locationAddress,   
                ]);
            }
        }
        
        if($location) {
            $shop->location_id = $location->id;
        }
        
        $currentImageUrl = $shop->shop_image_url;
        
        if($request->file('shop_image')){ //画像ファイルが送られた時だけ処理実行
            $image_url = Cloudinary::upload($request->file('shop_image')->getRealPath())->getSecurePath();
            $input['shop_image_url'] = $image_url; 
        } else {
            $input['shop_image_url']=$currentImageUrl;
        }
        
        $input_tags = $request->input('shop_tags_array',[]);
        
        $shop->ramen_tags()->sync($input_tags);
        
        $shop->update($input);
        
        return redirect("/shops/{$shop->id}/show/");
    }
    
    public function create(ShopCategory $shopcategory, RamenTag $ramentag, Review $review){
        return view('shops.create', [
            'categories' => $shopcategory->get(),
            'tags' => $ramentag->get(),
            'reviews' => $review->all(),
            ]);
    }
    
    public function delete(Shop $shop){
        $shop->delete();
        return redirect('/');
    }

    public function store(ShopRequest $request, Shop $shop){
        //auth()->user()メソッドを使用してログイン中のユーザーオブジェクトを取得しidを取得
        $userId = auth()->user()->id;
        
        $input = $request->input('shop');
        $locationAddress = $request->input('shop.location');
        
        $location = null;
        
        if($locationAddress){
            $coordinates = $this->geocodingService->getCoordinates($locationAddress);
            //あたらしいLocationインスタンスを作成し、保存
            if($coordinates) {
                $location = Location::create([
                    'address' => $locationAddress,
                    'latitude' => $coordinates['latitude'],
                    'longitude' => $coordinates['longitude'],
                ]);
            } else {
                $location = Location::create([
                    'address' => $locationAddress,   
                ]);
            }
        }
        
        if($location) {
            $shop->location_id = $location->id;
        }
        
        if($request->file('shop_image')){ //画像ファイルが送られた時だけ処理実行
            $image_url = Cloudinary::upload($request->file('shop_image')->getRealPath())->getSecurePath();
            $input += ['shop_image_url' => $image_url];
        }
        
        $input_tags = $request->input('tags_array',[]);
        $input['user_id'] = $userId;
        
        $shop->fill($input)->save();
        
        $shop->ramen_tags()->sync($input_tags);
        
        //return view('shops.showEdit')->with(['shop' => $shop]);
        return redirect("/shops/{$shop->id}/show/");
    }
    
    public function search(){
        return view('shops.search');
    }
}
