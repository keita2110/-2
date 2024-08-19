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
        // dd($input);
        
        $input_tags = $request->input('shop_tags_array',[]);
        // dd($input_tags);
        
        $shop->fill($input)->save();
        
        $shop->ramen_tags()->sync($input_tags);
        
        //return view('shops.showEdit')->with(['shop' => $shop]);
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
        $userId = auth()->id();
        
        $input = $request->input('shop');
        
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
