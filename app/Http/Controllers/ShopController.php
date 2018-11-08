<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Validator;

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
                'name' => 'bail|required|string|max:255',
                'cuisines_available' => 'bail|required|integer',
                'opening_hours' => 'bail|required|integer',
                'address' => 'bail|required|string|max:255',
                'phone_number' => 'bail|required|integer',
                'description' => 'bail|required|string|max:255',
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
            $shop->address = $request->address;
            $shop->phone_number = $request->phone_number;
            $shop->verified_phone = false;
            $shop->description = $request->description;
            $shop->status = 0;
            $shop->user_id = $request->user_id;
            $shop->save();

            return response()->json([
                'error' => false,
                'message' => 'Successfully created shop!',
                'data' => $shop->fresh(),
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
            // dd($shop->name);
            dd($request->name);
            $shop->name = $request->name;
            $shop->cuisines_available = $request->cuisines_available;
            $shop->opening_hours = $request->opening_hours;
            $shop->address = $request->address;
            $shop->phone_number = $request->phone_number;
            $shop->verified_phone = false;
            $shop->description = $request->description;
            $shop->status = $request->status;
            $shop->save();

            return response()->json([
                'error' => false,
                'message' => 'Successfully  updated!',
                'data' => $shop->fresh(),
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
}
