<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\bank;
use App\Models\UpiId;
use App\Models\User;
use App\Models\version;
use App\Models\PaytmId;
use DB;
class Bankcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function referrallink(request $request)
    {
        // dd('ssds');
         $checkUpdate  = version::first();
    
         if($checkUpdate)
         {
         $save_all = ['id'=>$checkUpdate->id,'referral_link'=>$checkUpdate->referral_link,'created_at'=>$checkUpdate->created_at,'updated_at'=>$checkUpdate->updated_at];
         return Response()->json([
            'status'=>"true",
            'msg'=>"Referral Link Fetch Successfully.",
            'data'=>$save_all
        ]);
        }
        else{
            return Response()->json([
            'status'=>"false",
            'msg'=>"No record Found.",
        ]);
        }      
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
    public function getBankDetails(Request $request)
    {
         $this->validate(request(), [
            'user_id' => 'required',
            'bank_name' => 'required',
            'account_name' => 'required',
            'ifsc_code' => 'required',
            'account_number' => 'required'
        ]);
        
         $checkUser = DB::table('user_banks')->where('user_id',$request->user_id)->first();

        if($checkUser==null)
        {
            $user = new bank;
           $user->user_id = $request->user_id;
            $user->bank_name = $request->bank_name;
            $user->account_name =  $request->account_name;
            $user->ifsc_code =  $request->ifsc_code;
            $user->account_number =  $request->account_number;
            $user->save();
            return response()->json([
                    'status' => "true",
                    'msg' => "Bank Add SuccessFully.",
                    "data" => $user
                ]);
        }
         else
         {  
            $id = $checkUser->id; 
            $user1= bank::where('user_id',$request->user_id)->update(['bank_name' =>$request->bank_name,'account_name'=>$request->account_name,'ifsc_code'=>$request->ifsc_code,'account_number'=> $request->account_number]);


              $save_data=['id' => $id , 'user_id' => $request->user_id,'bank_name' =>$request->bank_name,'account_name'=>$request->account_name,'ifsc_code'=>$request->ifsc_code,'account_number'=> $request->account_number];

              
            return response()->json([
                    'status' => "true",
                    'msg' => "Bank Edited SuccessFully.",
                    "data" => $save_data

                 ]);  
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
        //
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
        //
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

    public function UpiIds(Request $request)
    {
        $checkUser=User::where('id',$request->user_id)->first();
        if($checkUser)
        {
         $id = $checkUser->id; 
            $upi1= User::where('id',$request->user_id)->update(['upi_id' =>$request->upi_id]);


              $save_data=['id' => $id , 'user_id' => $request->user_id,'upi_id' =>$request->upi_id];

            return response()->json([
                    'status' => "true",
                    'msg' => "UPI add SuccessFully.",
                    "data" => $save_data
                ]);  
        }else
        {
            return response()->json([
                'status'=>"false",
                'msg'=>"User Not Found."
            ]);
        }

    }

 public function getUPI(Request $request)
    {
        $data= User::where('id',$request->user_id)->get();
        // dd($data);
        $save_all=[];
        foreach ($data as $value) {
        array_push($save_all,['id'=>$value->id,'user_id'=> $request->user_id,'upi_id'=>$value->upi_id,'created_at'=>$value->created_at,'updated_at'=>$value->updated_at]);
        }

        if($save_all)
        {
        
            return response()->json([
                        'status' => "true",
                        'msg' => "UPI Fetch SuccessFully.",
                        "data" => $save_all
                    ]);
        }
        else
        {
            
            return response()->json([
                    'status' => "false",
                    'msg' => "UPI Not Found.",
                ]);  
        }

    }
    public function getBank(Request $request)
    {
         $getBank = DB::table('user_banks')->where('user_id',$request->user_id)->get();
         $save_all =[];
         foreach ($getBank as $value) {
             array_push($save_all,['id'=>$value->id,'user_id'=> $value->user_id,'bank_name'=>$value->bank_name,'account_name'=>$value->account_name,'ifsc_code'=>$value->ifsc_code,'account_number'=>$value->account_number,'created_at'=>$value->created_at,'updated_at'=>$value->updated_at]);
        
         }
          if($save_all)
          {
          return response()->json([
            'status'=>"true",
            'msg'=> "Bank Fetch SuccessFully.",
            'data'=>$getBank
          ]);
      }
      else{
        return response()->json([
            'status'=>"false",
            'msg'=> "Bank Not Found."
          ]);
      }
    }

     public function PaytmID(Request $request)
    {
        $checkUser=User::where('id',$request->user_id)->first();
        if($checkUser)
        {

            $id = $checkUser->id; 
            $upi1= User::where('id',$request->user_id)->update(['paytm_id' =>$request->paytm_id]);
              $save_data=['id' => $id , 'user_id' => $request->user_id,'paytm_id' =>$request->paytm_id];

            return response()->json([
                    'status' => "true",
                    'msg' => "paytm id add SuccessFully.",
                    "data" => $save_data
                ]);  
        }
        else
        {
             return response()->json([
                    'status' => "false",
                    'msg'=>"User Not found."
                    
                ]);  
        }
    }

     public function getPaytm(Request $request)
    {
        $data= User::where('id',$request->user_id)->get();
        // dd($data);
        $save_all=[];
        foreach ($data as $value) {
        array_push($save_all,['id'=>$value->id,'user_id'=> $request->user_id,'paytm_id'=>$value->paytm_id,'created_at'=>$value->created_at,'updated_at'=>$value->updated_at]);
        }

        if($save_all)
        {
        
            return response()->json([
                        'status' => "true",
                        'msg' => "paytm id Fetch SuccessFully.",
                        "data" => $save_all
                    ]);
        }
        else
        {
            
            return response()->json([
                    'status' => "false",
                    'msg' => "paytm id Not Found.",
                ]);  
        }

    }
   
    
}

