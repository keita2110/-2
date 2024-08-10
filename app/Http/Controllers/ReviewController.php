<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    public function review(){
        return view('reviews.review');
    } 
    
    public function edit2(Review $review){
        return view('reviews.edit2')->with(['review' => $review]);
    }
    
    public function update2(ReviewRequest $request,Review $review){
        $input_review = $request['review'];
        $review->fill($input_review)->save();
        return redirect('/reviews/{review}/show.'.$review->id);
    }
    
    public function delete2(Review $review){
        $review->delete();
        return redirect('/shops/{shop}');
    }
    
    public function store2(ReviewRequest $request, Review $review){//要検討
        //auth()->user()メソッドを使用してログイン中のユーザーオブジェクトを取得しidを取得
        $userId = auth()->id();
        
        $input = $request['review'];
        //$input_tags = $request->tags_array;
        
        $input['user_id'] = $userId;
        
        $review->fill($input)->save();
        
        //$shop->ramen_tags()->attach($input_tags);
        return redirect('/reviews/{review}/show/'.$review->id);
    }
}
