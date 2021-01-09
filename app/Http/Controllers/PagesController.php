<?php

namespace App\Http\Controllers;
use App\Product;
use App\Log;
use Illuminate\Http\Request;

class PagesController extends Controller
{
/**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index(){

        $products = Product::orderBy('p_name','asc')->paginate(11);
        return view('pages.index')->with('products', $products);

        //$product = Product::all();
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add($p_id)
    {
        $product = Product::find($p_id);

        //check for correct user
        if($_SESSION["name"] == null ){
            return redirect('/')->with('error','Unauthorized Accesss');
        }

        return view('products.add')->with('product',$product);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function added(Request $request, $p_id)
    {
         //check for correct user
         if($_SESSION["name"] == null ){
            return redirect('/')->with('error','Unauthorized Accesss');
        }

        $purchase_price = $request->input('purchase_price');
        $quantity = $request->input('quantity');

        $product = Product::find($p_id);
        $product->p_quantity = $quantity;
        $product->p_purchase_price = $purchase_price;
        $product->p_total_purchase = $product->p_total_purchase + ($quantity * $purchase_price);
        $product->save();

        $log = new Log;
        $log->l_p_serial_number = $product->p_serial_no;
        $log->l_p_name = $product->p_name;
        $log->l_action = 'Purchase';
        $log->l_quantity = $quantity;
        $log->l_purchase_price = $purchase_price;
        $log->l_amount = $quantity * $purchase_price;
        $log->save();

        return redirect('/products')->with('success','Product Added');
    }

    public function log()
    {
         //check for correct user
         session_start();
         if($_SESSION["name"] == null ){
            return redirect('/')->with('error','Unauthorized Accesss');
        }

        $log = Log::orderBy('created_at','asc')->paginate(20);
        return view('logs.record')->with('log', $log);

    }

    public function search(){
        $search_text = $_GET['query'];
        $products = Product::where('p_name','LIKE', '%'.$search_text.'%')->get();

        return view('pages.search',compact('products'));
    }

    public function searched(){
        $search_text = $_GET['query'];
        $products = Product::where('p_name','LIKE', '%'.$search_text.'%')->get();

        return view('products.search',compact('products'));
    }
}
