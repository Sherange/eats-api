<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;
use PDF;

class OrderController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            $user = Auth::user();
            $validator = Validator::make($request->all(), [
                'amount' => 'bail|required|integer',
                'table_id' => 'bail|required|integer',
            ]);

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $error) {
                    return response()->json([
                        'error' => true,
                        'message' => $error
                    ], 400);
                }
            }

            $order = new Order;
            $order->amount = $request->amount;
            $order->table_id = $request->table_id;
            $order->user_id = $user->id;
            $order->save();
            $order->foodItems()->attach($request->food_items);


            return response()->json([
                'error' => false,
                'message' => 'Successfully placed your order',
                'data' => $order->fresh('foodItems'),
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
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders)
    {
        //
    }

    public function getOrderReport(Request $request)
    {
        try {
            $query = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            // ->join('orders', 'orders.id', '=', 'orders.user_id')
            ->select('orders.id', 'orders.amount', 'orders.table_id', 'users.name', 'orders.created_at')
            ->get();

            $balance = DB::table('orders')->sum('orders.amount');

            $queryLength = DB::table('orders')->count();


            $pdf = PDF::loadView(
                '/reports/order_report',
                [
                    'orders' => $query,
                    'balance' => $balance,
                    'length' => $queryLength
                ]
                
                );
         
            return $pdf->download('order_report.pdf');
            
            
            // return view('/reports/order_report', [
            //          'orders' => $query,
            //         'balance' => $balance,
            //         'length' => $queryLength
            //     ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => "Something went wrong please contact support center",
                'dev_message' => $e->getMessage()
            ], 400);
        }
    }
}
