<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
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
    public function store(Request $request)
    {
        
        
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 8; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
                   
       

        $credentials = request()->validate(['mobile_no' => 'required']);
        $credentials = request()->validate(['device_id' => 'required']);

        
        $user = User::where('mobile_no', $request->mobile_no)->first();
        if (!$user) 
        {
            
            $checkdevice = User::where('device_id',$request->device_id)->first();
            if($checkdevice == null)
            {
            $user = new User;
                
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile_no =  $request->mobile_no;
            $user->device_id =  $request->device_id;
            $user->password = Hash::make( $request->password);
            $user->referal_code = $randomString;
            $user->save();

            return response()->json([
                        'status' => "true",
                        'msg' => "Register SuccessFully.",
                        "data" => $user
                    ]);
            }
            // elseif($checkdevice !=  $request->device_id)
            // {
            //     // dd(sds);
            //     return response()->json([
            //             'status' => "false",
            //             'msg' => "Wrong Device ID. "
            //         ]);
            // }
            else
            {
                 return response()->json([
                        'status' => "false",
                        'msg' => "Already used device id."
                    ]);
            }

        }
        
        elseif($user)
        {
            $checkdevice = User::where('device_id',$request->device_id)->first();
            if($checkdevice == null)
            {
                if($request->device_id == $user->device_id)
                {


                $user = User::find($user->id);
                $user->device_id = $request->device_id;
                $user->save();

                }
                elseif($checkdevice != $user->device_id){

                // dd('sds');
                 return response()->json([
                            'status' => "false",
                            'msg' => "Wrong Device id."
                        ]);
                }                
                else
                {
                      return response()->json([
                        'status' => "false",
                        'msg' => "Already Used Device id."
                    ]);
                }
                
             return response()->json([
                        'status' => "true",
                        'msg' => "Login SuccessFully.",
                        "data" => $user
                    ]);
            }
            elseif($request->device_id == $user->device_id)
            {
                
                 return response()->json([
                        'status' => "true",
                        'msg' => "Login SuccessFully.",
                        "data" => $user
                    ]);
                
            }
            elseif($checkdevice != $user->device_id){

                // dd('sds');
             return response()->json([
                        'status' => "false",
                        'msg' => "Wrong Device id."
                    ]);
            }
             else{

                // dd('sds');
             return response()->json([
                        'status' => "false",
                        'msg' => "Already Used Device id."
                    ]);
            }
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

    public function checkMobilenumber(Request $request)
    {
        //
        

           $credentials = request()->validate(['mobile_no' => 'required']);

      $user = User::where('mobile_no', $request->mobile_no)->first();

        //dd($user);
        if($user)
        {
            
             return response()->json([
                        'status' => "true",
                        'msg' => "mobile has been existed.",
                    ]);
        }
        else
        {
            
            return response()->json([
                        'status' => "true",
                        'msg' => "mobile has been Not existed.",
                    ]);

         }
        }
        

}

