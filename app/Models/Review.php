<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable=[
        'body',
        'review',
        'review_image_url',
        'shop_id',//これも保存処理いるかも
        'user_id',
    ];
    
    protected static function boot(){
        parent::boot();
        
        static::saved(function ($review) {
            // レビューが保存された後、関連するショップのレビュー平均を更新
            $review->shop->updateReviewAvg();
        });

        static::deleted(function ($review) {
            // レビューが削除された後、関連するショップのレビュー平均を更新
            $review->shop->updateReviewAvg();
        });
    }
    
    public function shop(){
        return $this->shop(Shop::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
