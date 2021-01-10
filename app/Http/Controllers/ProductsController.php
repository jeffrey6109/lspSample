<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Product;
use App\Log;
session_start();
class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::all()->paginate(11);
        $products = Product::orderBy('p_name','asc')->paginate(11);
        //$posts = DB::select('SELECT * FROM posts');
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //check for correct user
        if($_SESSION["name"] == null ){
            return redirect('/')->with('error','Unauthorized Accesss');
        }else{
            return view('products.create');
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
        //check for correct user
        if($_SESSION["name"] == null ){
            return redirect('/')->with('error','Unauthorized Accesss');
        }

        $this->validate($request,[
            'name'=> 'required',
            'quantity'=> 'required',
            'purchase_price' => 'required',
            'total_purchase'=>'required',
            'sold_price'=>'required',
            'product_image'=>'image|nullable|max:1999'
        ]);

        //handle file upload
        if($request->hasFile('product_image')){
            //Get filename with the extension
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just Ext
            $extension=$request->file('product_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('product_image')->storeAs('public/product_image', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $charid = strtoupper(md5(uniqid(rand(), true),false));
		$uuid= substr($charid,1,16);
        $quantity =$request->input('quantity');
        $purchase_price = $request->input('purchase_price');

        //create post

        $product = new Product;
        $product->p_serial_no = $uuid;
        $product->p_name = $request->input('name');
        $product->p_quantity = $quantity;
        $product->p_purchase_price = $purchase_price;
        $product->p_sold_price = $request->input('sold_price');
        $product->p_total_purchase = $quantity * $purchase_price;
        $product->p_discount = $request->input('discount');
        $product->p_image = $fileNameToStore;
        $product->save();

        $log = new Log;
        $log->l_p_serial_number = $uuid;
        $log->l_p_name = $request->input('name');
        $log->l_action = 'New';
        $log->l_quantity = $quantity;
        $log->l_purchase_price = $purchase_price;
        $log->l_amount = $quantity * $purchase_price;
        $log->save();


        return redirect('/products')->with('success','Product added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($p_id)
    {
         //check for correct user
        if($_SESSION["name"] == null ){
        return redirect('/')->with('error','Unauthorized Accesss');
        }

        $products =  Product::find($p_id);
        return view('products.show')->with('products',$products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($p_id)
    {
         //check for correct user
         if($_SESSION["name"] == null ){
            return redirect('/')->with('error','Unauthorized Accesss');
        }

        $products = Product::find($p_id);

        //check for correct user
        if($_SESSION["name"] == null ){
            return redirect('/')->with('error','Unauthorized Accesss');
        }

        return view('products.edit')->with('products',$products);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $p_id)
    {
         //check for correct user
         if($_SESSION["name"] == null ){
            return redirect('/')->with('error','Unauthorized Accesss');
        }

        $this->validate($request,[
            'product_image'=>'image|nullable|max:1999'
        ]);

        //handle file upload
        if($request->hasFile('product_image')){
            //Get filename with the extension
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just Ext
            $extension=$request->file('product_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('product_image')->storeAs('public/product_image', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        $quantity =$request->input('quantity');
        $purchase_price = $request->input('purchase_price');

        //create post
        $product = Product::find($p_id);
        $product->p_name = $request->input('name');
        $product->p_quantity = $quantity;
        $product->p_purchase_price = $purchase_price;
        $product->p_sold_price = $request->input('sold_price');
        $product->p_total_purchase = $quantity * $purchase_price;
        $product->p_discount = $request->input('discount');
        if($request->hasFile('product_image')){
            $product->p_image = $fileNameToStore;
        }
        $product->updated_at = date("Y-m-d H:i:s");
        $product->save();

        $log = new Log;
        $log->l_p_serial_number = $product->p_serial_no;
        $log->l_p_name = $request->input('name');
        $log->l_action = 'Update';
        $log->l_quantity = $quantity;
        $log->l_purchase_price = $purchase_price;
        $log->l_amount = $quantity * $purchase_price;
        $log->save();


        return redirect('/products')->with('success','Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($p_id)
    {
        $product = Product::find($p_id);

        //check for correct user
        if($_SESSION["name"] == null ){
            return redirect('/')->with('error','Unauthorized Accesss');
        }

        if($product->p_image != 'noimage.jpg'){
            //Delete image
            Storage::delete('/public/storage/product_image/'.$product->p_image);
        }

        $log = new Log;
        $log->l_p_serial_number = $product->p_serial_no;
        $log->l_p_name = $product->p_name;
        $log->l_action = 'Delete';
        $log->l_quantity = 0;
        $log->l_purchase_price = 0;
        $log->l_amount = 0;
        $log->save();


        $product->delete();
        return redirect('/products')->with('success','Product Removed');
    }


}
