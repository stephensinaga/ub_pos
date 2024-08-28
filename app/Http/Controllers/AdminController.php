<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function Dashboard(){
        return view('dashboard');
    }

    public function CreateProductView()
    {
        $data = Product::all();

        return view('Admin.createProduct', compact('data'));
    }

    public function CreateProduct(Request $request)
    {
        $data = new Product;
        $data->product_name = $request->product_name;
        $data->product_code = $request->product_code;
        $data->product_category = $request->product_category;
        $data->product_price = $request->product_price;
        $data->save();

        return back()->with('Success', 'Create Product Success');
    }

    public function DeleteProduct($id)
    {
        $item = Product::where('id', $id)->first();
        $item->delete();

        return back();
    }

    public function EditProductView($id)
    {
        $item = Product::where('id', $id)->first();

        return view('Admin.editProduct', compact('item'));
    }

    public function EditProduct($id, Request $request)
    {
        $item = Product::where('id', $id)->first();
        $item->product_name = $request->product_name;
        $item->product_code = $request->product_code;
        $item->product_category = $request->product_category;
        $item->product_price = $request->product_price;

        $item->save();
        return redirect(route('CreateProductView'))->with('Success', 'Edit Product Success');
    }
}
