<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\UserAddress;
use App\User;


class UserController extends Controller
{
    /**
     *  Handles User Registration
     * @param Request $request
     * @return void
     * 
     */
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'bail|required|string|max:255',
                'email' => 'bail|required|unique:users|string|email|max:255',
                'password' => 'bail|required|string|max:255',
            ]);

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    return response()->json([
                        'error' => true,
                        'message' => $error
                    ], 400);
                }
            }

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json([
                'error' => false,
                'message' => 'Successfully created user!',
                'data' => $user->fresh(),
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
     * Get login user data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUser(Request $request)
    {
        $user = $request->user();
        $user->user_address = $user->userAddress()->first();
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'bail|required|string|max:100',
                'phone_number' => 'bail|required|unique:users,id|integer',
                'date_of_birth' => 'bail|required|date|before:today',
                'gender' => 'bail|required|string|max:100',
                'description' => 'bail|required|string',
                'address' => 'bail|required|string|max:100',
                'street_one' => 'bail|required|string|max:100',
                'street_two' => 'bail|string|max:100',
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

            $user->name = $request->name;
            $user->phone_number = $request->phone_number;
            $user->date_of_birth = $request->date_of_birth;
            $user->gender = $request->gender;
            $user->description = $request->description;

            $userAddress = UserAddress::firstOrNew(['user_id' => $user->id]);
            $userAddress->address = $request->address;
            $userAddress->street_one = $request->street_one;
            $userAddress->street_two = $request->steet_two;
            $userAddress->city = $request->city;
            $userAddress->country = $request->country;

            $user->userAddress()->save($userAddress);
            $user->save();

            return response()->json([
                'error' => false,
                'message' => 'User Successfully Updated!',
                'data' => $user->fresh('userAddress'),
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong please contact support center',
                'dev_message' => $e->getMessage(),
            ], 400);
        }
    }
}
