<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class FoodPhoto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_path', 'image_thumb', 'main_image', 'food_item_id'
    ];

    /**
     * Get the user that owns the phone.
     */
    public function foodItem()
    {
        return $this->belongsTo('App\foodItem');
    }
}
