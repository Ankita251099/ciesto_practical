<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\transaction;
use App\Models\User;
use App\Models\couponcode;
use App\Models\version;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = transaction::all();
        return response()->json([
                        'status' => "true",
                        'msg' => "Transaction Fetch SuccessFully.",
                        "data" => $data
                    ]);
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
   public function addamount(Request $request)
    {

        
        $getCouponId = couponcode::where('coupon_name',$request->coupon_code)->first();
        
                $getName = User::where('id',$request->user_id)->first();
                // dd($request->type);

                if($request->type == "deposite,coupon" )
                {
                     

                    $user1 = new transaction;
                    $user1->user_id = $request->user_id;
                    $user1->amount = $request->amount;
                    $user1->receipt_id =$request->receipt_id;
                    $user1->is_paid =  "1";
                    $user1->coupon_id= $getCouponId->id;
                    $user1->type =  "deposite";
                    $user1->save();
                        
                    $user[] =$user1;  
                    $final_coupon_amount =  ($request->amount * (15/100));  
                    $user2 = new transaction;
                    $user2->user_id = $request->user_id;
                    $user2->amount = $final_coupon_amount;
                    $user2->receipt_id =$request->receipt_id;
                    $user2->is_paid =  "1";
                    $user2->coupon_id= $getCouponId->id;
                    $user2->type =  "coupon";
                    $user2->save();

                    $user[] =$user2;

                        

                $userdata =  User::find($user[0]->user_id);
                if($request->type == 'wining')
                {
                    $userdata->balance = $getName->balance + $request->amount;
                    $userdata->winning_amount = $getName->winning_amount+$request->amount;
                }else
                {
                    $userdata->balance = $getName->balance + $request->amount;

                }
                $userdata->save();  

                $user[0]->winning_amount.=$userdata->winning_amount;
                $user[0]->balance.=$userdata->balance;
                $user[0]->name .=$getName->name;

                $save =['user_id'=>$request->user_id,'amount'=>$request->amount,'couponcode_amount'=>$final_coupon_amount,'receipt_id'=>$request->receipt_id,'is_paid'=>'1','coupon_id'=>$request->coupon_id,'type'=>'deposite,coupon','name'=>$getName->name,'balance'=>$userdata->balance,'winning_amount'=>$userdata->winning_amount];

            return response()->json([
                'status' => "true",
                'msg' => "amount Add SuccessFully.",
                "data" => $save
            ]);


                    
                }
                else
                {
                    $user = new transaction;
                    $user->user_id = $request->user_id;
                    $user->amount = $request->amount;
                    $user->receipt_id =$request->receipt_id;
                    $user->is_paid =  "1";
         
                    $user->type =  $request->type;
                    $user->save();

                    
                    $userdata =  User::find($user->user_id);
                    if($request->type == 'wining')
                    {
                        // $userdata->balance = $getName->balance + $request->amount;
                        $userdata->winning_amount = $getName->winning_amount+$request->amount;
                    }else
                    {
                        $userdata->balance = $getName->balance + $request->amount;

                    }
                    $userdata->save();  

                    $user->winning_amount.=$userdata->winning_amount;
                    $user->balance.=$userdata->balance;
                    $user->name .=$getName->name;


                return response()->json([
                    'status' => "true",
                    'msg' => "amount Add SuccessFully.",
                    "data" => $user
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
    public function TransactionHistroy(Request $request)
    {
        $data = transaction::where('user_id',$request->id)->get();
         // dd($date(format)a);
        // dd($data);
        $save_all=[];
        foreach ($data as $value) {
            
            $month = $value->created_at->format('M');
        
            array_push($save_all, ['id'=> $value->user_id,'amount'=>$value->amount,'is_paid'=>$value->is_paid, 'receipt_id'=>$value->receipt_id,'type'=>$value->type,'created_at'=>$value->created_at,'updated_at'=>$value->updated_at,'month'=>$month]);
        }
        $reversed = array_reverse($save_all);

        if($save_all)
        {
                 return response()->json([
                        'status' => "true",
                        'msg' => "Transaction Histroy Fetch SuccessFully.",
                        "data" =>$reversed
                         ]);
        }
        else
        {
            return response()->json([
                'status'=>'false',
                'msg'=>"Transaction Histroy Not Fetch SuccessFully."
            ]);
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
     
}
