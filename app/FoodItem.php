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
     * Get the photos for the food_item.
     */
    public function foodPhotos()
    {
        return $this->hasMany('App\FoodPhoto');
    }

    /**
     * Get the shop_details that belongs to food_item.
     */
    public function shop()
    {
        return $this->belongsTo('App\Shop', 'shop_id');
    }

    /**
     * Get the orders_details that belongs to food_item.
     */
    public function orders()
    {
        return $this->belongsToMany('App\FoodItem');
    }
}
