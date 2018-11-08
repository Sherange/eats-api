<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopPhoto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_path', 'image_thumb', 'main_image', 'shop_id'
    ];
}
