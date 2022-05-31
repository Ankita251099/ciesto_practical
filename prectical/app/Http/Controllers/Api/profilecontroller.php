<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\popup;
use App\Models\User;
use App\Models\couponcode;
class profilecontroller extends Controller
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
    public function checkCouponCode(Request $request)
    {
        $getcode = couponcode::where('coupon_name',$request->couponcode)->first();
        if($getcode)
        {
        return Response()->json([
            'status'=>"true",
            'msg'=>"Coupocode Fetch Successfully.",
            'data'=>$getcode
        ]);
        }
        else{
            return Response()->json([
                'status'=>"false",
                'msg'=>"Coupocode Not Found."
            ]);
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
    //

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
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request, User $user)
    {
        // dd($request->all());

      $data = User::find($request->id);
        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $url = public_path().'/upload/';
            $originalPath = $url;
            $name = time() . mt_rand(10000, 99999);
            $new_name = $name . '.' . $image->getClientOriginalExtension();
            $image->move($originalPath, $new_name);
            $data->name = $request['name']; 
            $data->email = $request['email'];
            $data->image = $new_name;
            $data->save();
        }
        if ($data->image == null)
         {
            $path = null;
            $data->name = $request['name']; 
            $data->email = $request['email'];
        }
        else
        {
            $data->name = $request['name']; 
            $data->email = $request['email'];
            $path = env('APP_URL').'/public/upload/'.$data->image;
        }
        $save_data=['id' => $data->id,'name' => $data->name,'email' => $data->email,'mobile_no'=> $data->mobile_no,'email_verified_at' => $data->email_verified_at,'image' => $path,
            'referal_code' => $data->referal_code];
       
        return response()->json([
            'status' => "true",
            'msg' => "Profile Edit SuccessFully.",
            "data" => $save_data
        ]);
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

    public function popupScreen(Request $request)
    {
        $popupScreen = popup::first();
        if($popupScreen == null)
        {   

            return Response()->json([
            'status'=>"true",
            'msg'=>"Popup Screen Fetch Successfully.",
            'data'=>$popupScreen
            ]);    
        }
        elseif($popupScreen->image)
        {
            $path = env('APP_URL').'/public/upload/image/'.$popupScreen->image;
        }
        $data =['id'=>$popupScreen->id,'image'=>$path,'link'=>$popupScreen->link,'created_at'=>$popupScreen->created_at,'updated_at'=>$popupScreen->updated_at];

          return Response()->json([
            'status'=>"true",
            'msg'=>"Popup Screen Fetch Successfully.",
            'data'=>$data
        ]);        
    }
}
