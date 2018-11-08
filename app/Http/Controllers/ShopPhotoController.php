<?php

namespace App\Http\Controllers;

use App\ShopPhoto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ShopPhotoController extends Controller
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
            $baseUrl = config('app.base_url');

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $fileExtension = $file->extension();
                $newFileName = "shops/" . uniqid() . "." . $fileExtension;
                Storage::putFileAs('public', $file, $newFileName);
            }

            $shopPhoto = new ShopPhoto();
            $shopPhoto->image_path = $baseUrl . "/storage/" . $newFileName;
            $shopPhoto->image_thumb = $baseUrl . "/storage/" . $newFileName;
            $shopPhoto->main_image = $request->main_image;
            $shopPhoto->shop_id = $request->shop_id;
            $shopPhoto->save();

            return response()->json([
                'error' => false,
                'message' => 'Photos Upload Successfully',
            ], 200);

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
     * @param  \App\ShopPhoto  $shopPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(ShopPhoto $shopPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShopPhoto  $shopPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShopPhoto $shopPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShopPhoto  $shopPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopPhoto $shopPhoto)
    {
        //
    }
}
