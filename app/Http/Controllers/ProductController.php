<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $min_price = $request->min_price;
        $max_price = $request->max_price;
      
        if($min_price != '' && $max_price != '')
        {
            $products=Product::where('price','>=',$min_price)->where('price','<=',$max_price)->get();
        } 
        else{
            $products=Product::all();

        }
        return view('product.view',compact('products','min_price','max_price'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shops = Shop::all();
        return view('product.add',compact('shops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'product_name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'shop_id' => 'required',

        ]);
        $checkproductname = Product::where('product_name',"LIKE",'%'.$request->product_name . '%')->where('shop_id',$request->shop_id)->get();

      if($checkproductname)
      {

        return redirect()->route('product.create')->with('message-error','product name is already  use');
      }
      else{


        $add= new product;
        $add->product_name = $request->product_name;
        $add->price = $request->price;
        $add->stock = $request->stock;
        $add->shop_id = $request->shop_id;
        if($request->has('video'))
        {
            $image = $request->file('video');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/video');
            $image->move($destinationPath, $name);
            $add->video = $name;
         }
         $add->save();

        return redirect()->route('product.index')->with('success','product Created successfully');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::find($id);
        return view('product.edit',compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         
         $update = Product::find($id);
        $update->product_name = $request->product_name;
        $update->price = $request->price;
        $update->stock = $request->stock;
        $update->shop_id = $request->shop_id;
        if($request->has('video'))
        {
            $image = $request->file('video');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/video');
            $image->move($destinationPath, $name);
            $update->video = $name;
         }
         $update->save();
         $update->save();
            return redirect()->route('shop.index')->with('success','Shop Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function import(request $request)
    {
        $path =$request->file('excelfile');
        Excel::import(new ProductImport  ,$request->file('excelfile'));
        return back();
    }
}
