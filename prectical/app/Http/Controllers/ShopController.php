<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::orderby('id','desc')->get();
        return view('shop.view',compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('shop.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         $add = New Shop;
         $add->shop_name= $request->shop_name;
         $add->email = $request->email;
         $add->address = $request->address;
         if($request->has('image'))
        {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/image');
            $image->move($destinationPath, $name);
         $add->image = $name;
         }
         dd($add);
         $add->save();
            return redirect()->route('shop.index')->with('success','Shop Created successfully');
        
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
        $shops = Shop::find($id);
        return view('shop.edit',compact('shops'));
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
        
         $update = Shop::find($id);
         $update->shop_name= $request->shop_name;
         $update->email = $request->email;
         $update->address = $request->address;
         if($request->has('image'))
        {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/image');
            $image->move($destinationPath, $name);
         $update->image = $name;
         }
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
        $shops = Shop::find($id);
        $shops->delete();
        return redirect()->route('shop.index')->with('success','Shop deleted successfully');
    }

    public function import(request $request)
    {
        dd($request->all());
        $path =$request->file('excelfile');
        Excel::import(new Shop,$request->file('excelfile'));
        return back();
    }
}
