<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function OrderView(){
        $data = Product::all();
        $order = Order::where('status', 'pending')->get();
        return view('Admin.orderProduct', compact('data', 'order'));
    }

    public function OrderProduct($id){
        $item = Product::where('id', $id)->first();
        $data = new Order();
        $data->product_id = $item->id;
        $data->product_name = $item->product_name;
        $data->product_code = $item->product_code;
        $data->product_category = $item->product_category;
        $data->product_price = $item->product_price;
        $data->status = 'pending';
        $data->save();
    }

    public function DeletePendingProduct($id){
        $item = Order::where('id', $id)->first();
        $item->delete();
        return back();
    }

}
