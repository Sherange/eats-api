<?php

namespace App\Http\Controllers;

use App\FoodItem;
use Illuminate\Http\Request;
use Validator;
use League\Flysystem\Exception;

class FoodItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                'category' => 'bail|required|integer',
                'type' => 'bail|required|integer',
                'price' => 'bail|required|integer',
                'description' => 'bail|required|string',
            ]);

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    return response()->json([
                        'error' => true,
                        'message' => $error
                    ], 400);
                }
            }

            $foodItem = new FoodItem();
            $foodItem->name = $request->name;
            $foodItem->category = $request->category;
            $foodItem->type = $request->type;
            $foodItem->price = $request->price;
            $foodItem->description = $request->description;
            $foodItem->shop_id = $request->shop_id;
            $foodItem->save();

            return response()->json([
                'error' => false,
                'message' => 'Successfully created food item!',
                'data' => $foodItem->fresh(),
            ], 201);

        } catch (\Exception $e) {
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
     * @param  \App\FoodItem  $foodItem
     * @return \Illuminate\Http\Response
     */
    public function show(FoodItem $foodItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FoodItem  $foodItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FoodItem $foodItem)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'bail|required|string|max:100',
                'category' => 'bail|required|integer',
                'type' => 'bail|required|integer',
                'price' => 'bail|required|integer',
                'description' => 'bail|required|string',
            ]);

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    return response()->json([
                        'error' => true,
                        'message' => $error
                    ], 400);
                }
            }

            $foodItem->name = $request->name;
            $foodItem->category = $request->category;
            $foodItem->type = $request->type;
            $foodItem->price = $request->price;
            $foodItem->description = $request->description;
            $foodItem->shop_id = $request->shop_id;
            $foodItem->save();

            return response()->json([
                'error' => false,
                'message' => 'Food item successfully updated!',
                'data' => $foodItem->fresh(),
            ], 200);

        } catch (\Exception $e) {

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FoodItem  $foodItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodItem $foodItem)
    {
        //
    }
}
