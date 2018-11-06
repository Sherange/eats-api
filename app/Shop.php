<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'cuisines_available', 'opening_hours', 'address', 'phone_number', 'verified_phone', 'description', 'status'
    ];
}
