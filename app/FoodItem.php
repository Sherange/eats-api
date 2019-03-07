<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category', 'type', 'price', 'description', 'shop_id'
    ];

    /**
     * Get the photos for the food.
     */
    public function foodPhotos()
    {
        return $this->hasMany('App\FoodPhoto');
    }

     /**
     * Get the post that owns the comment.
     */
    public function shop()
    {
        return $this->belongsTo('App\Shop', 'shop_id');
    }
}
