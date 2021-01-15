<?php

namespace App\Http\Controllers;
use App\Product;
use App\Log;
use App\Transaction;
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

        $charid = strtoupper(md5(uniqid(rand(), true),false));
		$uuid= substr($charid,1,16);
        $purchase_price = $request->input('purchase_price');
        $quantity = $request->input('quantity');

        $product = Product::find($p_id);
        $product->p_quantity = $product->p_quantity + $quantity;
        $product->p_purchase_price = $purchase_price;
        $product->save();

        //operation log
        $log = new Log;
        $log->l_p_serial_number = $product->p_serial_no;
        $log->l_p_name = $product->p_name;
        $log->l_action = 'Purchase';
        $log->l_quantity = $quantity;
        $log->l_purchase_price = $purchase_price;
        $log->l_total_purchase = $quantity * $purchase_price;
        $log->save();

        //transaction log
        $transaction = new Transaction;
        $last_r = $transaction->latest('created_at')->where('action','Purchase')->first();

        $transaction->uuid = $uuid;
        $transaction->p_serial_no = $product->p_serial_no;
        $transaction->p_name = $product->p_name;
        $transaction->quantity = $quantity;
        $transaction->credit = $quantity * $purchase_price;
        if(isset($last_r)){
            $transaction->total_purchase = $last_r->total_purchase + ($quantity * $purchase_price);
        }else{
            $transaction->total_purchase = $quantity * $purchase_price;
        }
        $transaction->discount =$product->p_discount;
        $transaction->action = 'Purchase';
        $transaction->save();

        return redirect('/products')->with('success','Product Added');
    }

    public function minus(Request $request, $p_id)
    {
         //check for correct user
         if($_SESSION["name"] == null ){
            return redirect('/')->with('error','Unauthorized Accesss');
        }

        $charid = strtoupper(md5(uniqid(rand(), true),false));
		$uuid= substr($charid,1,16);
        $sold_price = $request->input('sold_price');
        $quantity = $request->input('quantity');

        $product = Product::find($p_id);
        $product->p_quantity = $product->p_quantity - $quantity;
        $product->p_purchase_price = $sold_price;
        $product->save();

        //operation log
        $log = new Log;
        $log->l_p_serial_number = $product->p_serial_no;
        $log->l_p_name = $product->p_name;
        $log->l_action = 'Sold';
        $log->l_quantity = $quantity;
        $log->l_sold_price = $sold_price;
        $log->l_total_sold = $quantity * $sold_price;
        $log->save();

        //transaction log
        $transaction = new Transaction;
        $last_r = $transaction->latest('created_at')->where('action','Sold')->first();

        $transaction->uuid = $uuid;
        $transaction->p_serial_no = $product->p_serial_no;
        $transaction->p_name = $product->p_name;
        $transaction->quantity = $quantity;
        $transaction->debit = $quantity * $sold_price;
        if(isset($last_r)){
            $transaction->total_sold = $last_r->total_sold + ($quantity * $sold_price);
        }else{
            $transaction->total_sold = $quantity * $sold_price;
        }
        $transaction->discount =$product->p_discount;
        $transaction->action = 'Sold';
        $transaction->save();

        return redirect('/')->with('success','Product sold');
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
