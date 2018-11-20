<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopAddress extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'address', 'street_one', 'street_two', 'latitude', 'longitude', 'zip_code', 'city', 'country'
    ];
}
