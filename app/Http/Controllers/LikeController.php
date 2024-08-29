<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Review;
use App\Models\Like;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Review $review, User $user){
        $userId = auth()->user()->id;
        
        $like = Like::where('review_id',$review->id)->where('user_id',$userId)->first();
        //review_idとuser_idに基づいて、既存のいいねを検索する
        
        if($like){
            $like->delete();
        } else {
            Like::create([
                'review_id' => $review->id,
                'user_id' => $userId,
            ]);
        }   
        
        $shopId=$review->shop_id;
        
        return redirect()->route('shops.show', $shopId);
    }
}
