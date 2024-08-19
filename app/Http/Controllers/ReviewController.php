<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    public function create(Shop $shop){
        return view('reviews.create',[
            'shop' => $shop,
        ]);
    } 
    
    public function reviewEdit(Review $review, Shop $shop){
        $review=Review::find($review->id);
        
        return view('reviews.reviewEdit',[
            'review' => $review,
            'shop' => $shop,
        ]);
    }
    
    public function edit2(Shop $shop, Review $review){
        return view('reviews.edit2',[
            'shop' => $shop,
            'review' => $review,
        ]);
    }
    
    public function update2(ReviewRequest $request,Review $review){
        $input=$request['post'];
        $review->fill($input)->save();
        return redirect("/reviews/{$review->id}/show/");
    }
    
    public function delete2(Review $review){
        $review->delete();
        return redirect("/shops/{$review->shop_id}/show");
    }
    
    public function store(ReviewRequest $request, Review $review){//要検討
        //auth()->user()メソッドを使用してログイン中のユーザーオブジェクトを取得しidを取得
        $userId = auth()->user()->id;
        $input = $request['post'];
        $input['user_id']=$userId;
        
        $review->fill($input)->save();
        
        return redirect("/reviews/{$review->id}/show/");
    }
}
