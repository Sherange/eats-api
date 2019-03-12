<?php

namespace App\Http\Controllers;

use App\Shop;
use App\ShopAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\ShopPhotos;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $shop = Shop::where('status', 1)->get();

            if (count($shop) > 0) {
                return response()->json([
                    'error' => false,
                    'data' => $shop,
                ], 200);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Shops not available',
                ], 400);
            }

        } catch (\Excepton $e) {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong please contact support center',
                'dev_message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'bail|required|string|max:100',
                'cuisines_available' => 'bail|required|integer',
                'opening_hours' => 'bail|required|integer',
                'phone_number' => 'bail|required|integer',
                'description' => 'bail|required|string',
                'address' => 'bail|required|string|max:100',
                'street_one' => 'bail|required|string|max:100',
                'street_two' => 'bail|nullable|string|max:100',
                'city' => 'bail|string|max:100',
                'country' => 'bail|string|max:100',
            ]);

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    return response()->json([
                        'error' => true,
                        'message' => $error
                    ], 400);
                }
            }

            $shop = new Shop;
            $shop->name = $request->name;
            $shop->cuisines_available = $request->cuisines_available;
            $shop->opening_hours = $request->opening_hours;
            $shop->phone_number = $request->phone_number;
            $shop->verified_phone = false;
            $shop->description = $request->description;
            $shop->status = 0;
            $shop->user_id = $request->user_id;
            $shop->save();

            $shopAddress = new ShopAddress;
            $shopAddress->address = $request->address;
            $shopAddress->street_one = $request->street_one;
            $shopAddress->street_two = $request->street_two;
            $shopAddress->city = $request->city;
            $shopAddress->country = $request->country;
            $shop->shopAddress()->save($shopAddress);

            return response()->json([
                'error' => false,
                'message' => 'Successfully created shop!',
                'data' => $shop->fresh('shopAddress'),
            ], 201);

        } catch (\Excepton $e) {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong please contact support center',
                'dev_message' => $e->getMessage(),
            ], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        try {
          
          $shop->shop_address =  $shop->shopAddress()->first();
          $shop->shop_photos =  $shop->shopPhotos()->get();
          //$shop->shop_foodItems =  $shop->shopFoodItems()->get();
           
           return response()->json([
                'error' => false,
                'data' => $shop,
            ], 200);

        } catch (\Excepton $e) {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong please contact support center',
                'dev_message' => $e->getMessage(),
            ], 400);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'bail|required|string|max:255',
                'cuisines_available' => 'bail|required|integer',
                'opening_hours' => 'bail|required|integer',
                'phone_number' => 'bail|required|integer',
                'description' => 'bail|required|string',
                'address' => 'bail|required|string|max:100',
                'street_one' => 'bail|required|string|max:100',
                'street_two' => 'bail|nullable|string|max:100',
                'city' => 'bail|string|max:100',
                'country' => 'bail|string|max:100',
            ]);

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    return response()->json([
                        'error' => true,
                        'message' => $error
                    ], 400);
                }
            }

            $shop->name = $request->name;
            $shop->cuisines_available = $request->cuisines_available;
            $shop->opening_hours = $request->opening_hours;
            $shop->phone_number = $request->phone_number;
            $shop->verified_phone = false;
            $shop->description = $request->description;
            $shop->status = $request->status;

            $shopAddress = ShopAddress::firstOrNew(['shop_id' => $shop->id]);
            $shopAddress->address = $request->address;
            $shopAddress->street_one = $request->street_one;
            $shopAddress->street_two = $request->street_two;
            $shopAddress->city = $request->city;
            $shopAddress->country = $request->country;
            $shop->shopAddress()->save($shopAddress);
            $shop->save();

            return response()->json([
                'error' => false,
                'message' => 'Successfully  updated!',
                'data' => $shop->fresh(['shopPhotos', 'shopAddress']),
            ], 200);

        } catch (\Excepton $e) {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong please contact support center',
                'dev_message' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        try {

            $shop->delete();

            return response()->json([
                'error' => false,
                'message' => 'Successfully removed!'
            ], 200);

        } catch (\Excepton $e) {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong please contact support center',
                'dev_message' => $e->getMessage(),
            ], 400);
        }
    }

    public function getUserShops(Request $request)
    {
        try {
            $user = Auth::user();
            $shops = Shop::where('user_id', $user->id)
                ->with(['shopPhotos', 'shopAddress'])
                ->orderBy('id', 'desc')
                ->get();

            return response()->json([
                'error' => false,
                'data' => $shops,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong please contact support center',
                'dev_message' => $e->getMessage(),
            ], 400);
        }
    }
}
