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


    /**
     * Get the photos for the shop.
     */
    public function shopPhotos()
    {
        return $this->hasMany('App\ShopPhoto')->orderBy('id', 'desc');
    }

     /**
     * Get the foods for the shop.
     */
    public function shopFoodItems()
    {
        return $this->hasMany('App\FoodItem')->orderBy('id', 'desc');
    }
    /**
     * Get the address of the shop.
     */
    public function shopAddress()
    {
        return $this->hasOne('App\ShopAddress');
    }
}
