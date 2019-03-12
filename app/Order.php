<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'amount', 'table_id', 'user_id'
    ];
    /**
     * Get the food_items that belongs to order.
     */
    public function foodItems()
    {
        return $this->belongsToMany('App\FoodItem');
    }
      /**
     * Get the users that belongs to order.
     */
    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}
