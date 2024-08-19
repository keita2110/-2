<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable=[
        'name',
        'reserve',
        'menu',
        'open_time',
        'close_time',
        'phone',
        'min_price',
        'max_price',
        'shop_image_url',
        'location_id',
        'shop_category_id',
        'user_id',
        'location'
    ];
    
    //作ってから確認
    
    public function updateReviewAvg(){
        $avg = $this->reviews()->avg('review');
        $this->update(['review_avg'=> $avg]);
    }
    
    public function location(){
        return $this->belongsTo(Location::class);
    }
    
    public function shop_category(){
        return $this->belongsto(ShopCategory::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    
    public function ramen_tags(){
        return $this->belongsToMany(RamenTag::class);
    }
}