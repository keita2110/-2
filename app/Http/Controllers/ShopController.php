<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\RamenTag;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\ShopRequest;

class ShopController extends Controller
{
    public function index()
    {
        return view('shops.index');//->with(['shops' => $shop->get()]);
    }
    
    public function show(Shop $shop){
        $shop->load(['shop_category','ramen_tags','reviews','location']);
        // レビュー平均を更新
        $shop->updateReviewAvg();
        return view('shops.show')->with(['shop' => $shop]);
    }
    
    public function showEdit(Shop $shop){
        $shop->load(['shop_category','ramen_tags','reviews','location']);
        // レビュー平均を更新
        $shop->updateReviewAvg();
        return view('shops.edit2')->with(['shop' => $shop]);
    }
    
    public function edit(Shop $shop){
        return view('shops.edit')->with(['shop' => $shop]);
    }
    
    public function update(ShopRequest $request, Shop $shop) {
        //$userId = auth()->id();
        
        $input_shop = $request['shop'];
        $input_tags = $request->tags_array;
        
        //$input_shop['user_id'] = $userId;
        
        $shop->fill($input_shop)->save();
        
        $shop->ramen_tags()->attach($input_tags);
        return redirect('/shops/{shop}/show/'.$shop->id);
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
    
    // public function review(){
        
    // }
    
    public function store(ShopRequest $request, Shop $shop){
        //auth()->user()メソッドを使用してログイン中のユーザーオブジェクトを取得しidを取得
        $userId = auth()->id();
        
        $input = $request['shop'];
        $input_tags = $request->tags_array;
        
        $input['user_id'] = $userId;
        
        $shop->fill($input)->save();
        
        $shop->ramen_tags()->attach($input_tags);
        return redirect('/shops/{shop}/show/'.$shop->id);
    }
}
