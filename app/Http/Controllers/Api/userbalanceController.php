<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SpinAlogorithm;
use App\Models\Spin;
use App\Models\transaction;
use App\Models\Temporary;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class userbalanceController extends Controller
{
      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index(Request $request)
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
      public function getBalance(Request $request,User $User)
      {
        $data = User::find($request->id);

        if($data->referal_id == 0)
        {
              // dd('asss');
          $data->status = '0';
          $data->save();
        }
        else
        {
              // dd('sdsd');
          $data->status = '1';
          $data->save();
        }
        if($data->image == null)
        {
          $path = null;
              // $data->balance = $data->balance + $request->balance;
          $data->save();
        }
        else
        {
          $path = env('APP_URL').'/public/upload/'.$data->image;
              // $data->balance = $data->balance + $request->balance;
          $data->save();
        }
            if($data->referal_id == null)
        {
          $disable = 0;
        }
        else
        {
          $disable = 1; 

        }
         $getReferalCode = User::where('id',$data->referal_id)->first();
         if($data->referal_id == null)
         {
          $referal_code = null;
         }
         else
         {
          $referal_code = $getReferalCode->referal_code;
         }
         
        $save_data=['id' => $data->id,'name' => $data->name,'email' => $data->email,'mobile_no'=> $data->mobile_no,'email_verified_at' => $data->email_verified_at,'image' => $path, 'balance' => $data->balance,'winning_amount'=>$data->winning_amount,'bonus'=>$data->bonus,'status'=>$data->status,'referal_code' => $data->referal_code,'kyc_status'=>$data->kyc_status,'disable'=>$disable,'use_referal_Code'=>$referal_code];   

        return response()->json([
          'status' => "true",
          'msg' => "Balance Fecth SuccessFully.",
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

      public function getReferalCode( Request $request)
      {   
        $data1 = User::where('referal_code',$request->referal_code)->first();
        $getUser = User::where('id',$request->id)->first();
        // dd($getUser);
        // $data = User::where('referal_code',$request->referal_code)->where('referal_id',0)->first();
          if($getUser)
        {
          if($data1)
          {

          if ($getUser->referal_id == null) 
          {
            $update = User::find($getUser->id);
            $update->referal_id = $data1->id;
            $update->save();

            $bonus = User::find($data1->id);
            $bonus->bonus = $bonus->bonus+100;
            $bonus->save();

            return response()->json([
              'status' =>"true",
              'msg'=>'Referal Code Store SuccessFully.'
                  
            ]);
          }
          else{
            return response()->json([
              'status' =>"false",
              'msg'=>'Referal Code is used.'  
            ]);
          }
        }
        else{
          return response()->json([
            'status' =>"false",
            'msg'=>'Referal Code Not Found.'
          ]);
        }
      }
      else
      {
          return response()->json([
            'status' =>"false",
            'msg'=>'User Not Found.'
          ]);
      }
      }

      
      public function spinCount(Request $request)
      {
       $rules = array(
        'user_id' => 'required',
        'spinner_id'=>'required',
      );
       $messages = array(
        'user_id.required' => 'Please enter user id.',
        'spinner_id.required' =>'Please enter spinner id'
      );

       $validator = Validator::make($request->all(), $rules, $messages);

       if ($validator->fails()) {

        $msg = $validator->messages();
        return ['status' => "false",
        'msg' => $msg];
      }
      $getUserName = User::where('id',$request->user_id)->first();
      $getSpinID = Spin::where('id',$request->spinner_id)->first();
      if($getUserName)
      {
        if($getSpinID)
        {
          $add = new SpinAlogorithm;
          $add->user_id =$request->user_id;
          $add->spinner_id =$request->spinner_id;
          $add->per =$request->per;
          $add->count =$request->count;
          $add->winning_amount =$request->winning_amount;
          $add->save();
        }
        else{
          return response()->json([
            'status' => "false",
            'msg' => "Spin id not found.",
          ]);
        }

        return response()->json([
          'status' => "true",
          'msg' => "Spin Count Add SuccessFully.",
          "data" => $add
        ]);
      }
      else{
        return response()->json([
          'status' => "false",
          'msg' => "User not found.",
        ]);

      }
    }
    public function getSpinCount(Request $request)
    {
     $getSpinCount = SpinAlogorithm::where('user_id',$request->user_id)->where('spinner_id',$request->spinner_id)->get();

     foreach ($getSpinCount as $value) {
       $save =  ['count'=>$value->count]; 
     }
     if($save){

       return response()->json([
        'status'=>"true",
        'msg'=>"Spin Count Fetch SuccessFully.",
        'data'=>$save
      ]);
     }

     else
     {
      return response()->json([
        'status' => "false",
        'msg' => "Spin Count Not Fetch found.",
      ]);
    }

  }


  public function percentageCount(Request $request)
  {

   $getSpin = Spin::where('id',$request->spinner_id)->first();
   if($getSpin)
   {
    $getSpinAlgorithm = SpinAlogorithm::where('spinner_id',$request->spinner_id)->get();
    foreach ($getSpinAlgorithm as $key => $value) {
      $getTotalcount = 1;

      $getTotalcount = SpinAlogorithm::where('spinner_id',$value->spinner_id)->sum('count');
                    // dd($getTotalcount);
      if($getTotalcount == 100)
      {
                      // dd($value->spinner_id)
        DB::table('spin_alogorithm')->where('spinner_id',$request->spinner_id)->delete();

      }
    }
    $getAlgorithm = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$request->percentage)->first();

    $status1 = true;
    $status2 = true;
    $status3 = true;
    if($getAlgorithm == null)
    {
      $add = new SpinAlogorithm;

      $add->spinner_id =$request->spinner_id;
      $add->per =$request->percentage;
      $add->count = 1;

                  // dd($add->count);
      $add->save();

      $add1 = new Temporary;
                  // dd($add);

      $add1->spinner_id =$request->spinner_id;
      $add1->per =$request->percentage;
      $add1->count = 1;
      $add1->save();


    }
    else{

        

        $checkdata =  SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$request->percentage)->first();

        if((int)$request->percentage == (int)$getSpin->per){
          if((int)$getSpin->per > $checkdata->count){
              $update= SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getSpin->per)->update(['count' =>$getAlgorithm->count+1]);

              $add1 = new Temporary;
                          // dd($add);
              $add1->spinner_id =$request->spinner_id;
              $add1->per =$request->percentage;
              $add1->count = 1;
              $add1->save();
          }
          else{
            $status1 = false;         
          }
        }
        else{
          $checkdata_per1 =  SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getSpin->per)->first();
          if ($checkdata_per1) {
            if($checkdata_per1->count >= (int)$getSpin->per){
              $status1 = false;
            }
          }

        }


        if((int)$request->percentage == (int)$getSpin->per2)
        {
            if((int)$getSpin->per2 > $checkdata->count){
              $update= SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getSpin->per2)->update(['count' =>$getAlgorithm->count+1]);

              $add1 = new Temporary;
                          // dd($add);
              $add1->spinner_id =$request->spinner_id;
              $add1->per =$request->percentage;
              $add1->count = 1;
              $add1->save();
          }
          else{
            $status2 = false;         
          }
        }
        else{
          $checkdata_per2 =  SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getSpin->per2)->first();

            if ($checkdata_per2) {

              if($checkdata_per2->count >= (int)$getSpin->per2){
                $status2 = false;
              }
            }

        }


        if((int)$request->percentage == (int)$getSpin->per3)
        {
          if((int)$getSpin->per3 > $checkdata->count){
              $update= SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getSpin->per3)->update(['count' =>$getAlgorithm->count+1]);

              $add1 = new Temporary;
                          // dd($add);
              $add1->spinner_id =$request->spinner_id;
              $add1->per =$request->percentage;
              $add1->count = 1;
              $add1->save();
          }
          else{
            $status3 = false;         
          }
        }
        else{
          $checkdata_per3 =  SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getSpin->per3)->first();
            if ($checkdata_per3) {
             if($checkdata_per3->count >= (int)$getSpin->per3){
                $status3 = false;
              }
            }
          //dd((int)$getSpin->per3,$checkdata_per3->count);
          
        }





            


    }
    // dd($status1,$status2,$status3);
  // dd($update);
    $checkspin =Spin::where('id',$request->spinner_id)->first();
                  // dd($checkspin->per,$checkspin->per2,$checkspin->per3,$request->percentage);
    $request_spin = null;

    if($checkspin->per == $request->percentage)
    {
      $request_spin = 0;
    }
    elseif ($checkspin->per2 == $request->percentage) {
      $request_spin = 1;
    }
    elseif ($checkspin->per3 ==$request->percentage) {
                  # code
      $request_spin = 2;
    }
    $checkAlogorithm = SpinAlogorithm::where('spinner_id',$request->spinner_id)->get();

    $save =[];
    $per1 =0;
    $per2=0;
    $per3=0;
                // dd($request_spin);
              // dd(count($checkAlogorithm));
    if (count($checkAlogorithm)>0) {
                // dd('sd');
      if (count($checkAlogorithm)==1) {
                  // dd('as');

       foreach ($checkAlogorithm as $key => $value) {
                  // dd('asd');

        $getper2 = $checkspin->per2;
        $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper2)->first();
        if($checkAlogorithm1)
        {
          $per2 = $checkAlogorithm1->count;
        }
        $getper3 = $checkspin->per3;
        $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper3)->first();
        if ($checkAlogorithm1) {
                # code...
          $per3 = $checkAlogorithm1->count;
        }
              // dd($per3);
        if($request_spin == 0)
        {
          $per1 = $value->count;

        }
        elseif ($request_spin == 1) {
          $per2 = $value->count;

        }
        elseif ($request_spin == 2) {
          $per3 = $value->count;

        }
        $save =[['spinner_id'=>$getSpin->id,'per'=>$getSpin->per,'count'=>(int)$per1,'status' => $status1],['spinner_id'=>$getSpin->id,'per'=>$getSpin->per2,'count'=>(int)$per2,'status' => $status2],['spinner_id'=>$getSpin->id,'per'=>$getSpin->per3,'count'=>(int)$per3,'status' => $status3]];
      }
    }
    elseif (count($checkAlogorithm)==2) {

                    // dd($request_spin);
      foreach ($checkAlogorithm as $key => $value) {
                  // dd($value);
                // dd('dsd');
        $getper1 = $checkspin->per;
        $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper1)->first();

        if ($checkAlogorithm1) {
          $per1 = $checkAlogorithm1->count;
        }
              // dd($per1);
        $getper2 = $checkspin->per2;
        $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper2)->first();
        if ($checkAlogorithm1) {
                # code...
          $per2 = $checkAlogorithm1->count;
        }

        $getper3 = $checkspin->per3;
        $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper3)->first();
              //dd($checkAlogorithm1);
        if ($checkAlogorithm1) {
          $per3 = $checkAlogorithm1->count;
        }


        $save =[['spinner_id'=>$getSpin->id,'per'=>$getSpin->per,'count'=>(int)$per1,'status' => $status1],['id'=>$getSpin->id,'per'=>$getSpin->per2,'count'=>(int)$per2,'status' => $status2],['spinner_id'=>$getSpin->id,'per'=>$getSpin->per3,'count'=>(int)$per3,'status' => $status3]];
      }
    }
    elseif (count($checkAlogorithm)==3) {
          ///3 ju
                // dd($request_spin);
      foreach ($checkAlogorithm as $key => $value) {
                // dd('aaa');

       $getper1 = $checkspin->per;
       $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper1)->first();
       if ($checkAlogorithm1) {
        $per1 = $checkAlogorithm1->count;
      }
                // dd($per1);


      $getper2 = $checkspin->per2;
      $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper2)->first();
      if ($checkAlogorithm1) {
                # code...
        $per2 = $checkAlogorithm1->count;
      }

      $getper3 = $checkspin->per3;
      $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper3)->first();
              //dd($checkAlogorithm1);
      if ($checkAlogorithm1) {
        $per3 = $checkAlogorithm1->count;
      }


      if($key==0){
        if ($per1 == 0) {
                      # code...
          if ($request_spin == 0) {
                      // dd('sd');
            $per1 = $value->count;
                    // dd($per1);  
          }
        }

      }

      elseif($key == 1){
        if($per2 == 0){

          if($request_spin ==1)
          {
            $per2 =$value->count;

          }
        }
      }

      elseif($key==2){
        if ($per3 == 0) {
                      # code...
          if($request_spin == 2)
          {
                    // echo "2AAA";
            $per3=$value->count;
          }
        }
      }


                  // $b = $per3;
                  //dd($b);

                 // dd($per3);
      $save =[
       ['spinner_id'=>$getSpin->id,'per'=>$getSpin->per,'count'=>(int)$per1,'status' => $status1],
       ['spinner_id'=>$getSpin->id,'per'=>$getSpin->per2,'count'=>(int)$per2,'status' => $status2],
       ['spinner_id'=>$getSpin->id,'per'=>$getSpin->per3,'count'=>(int)$per3,'status' => $status3]];
       break;
     }

   }
 }

 return response()->json([
  'status'=>'true',
  'msg'=>"percentage Count SuccessFully. ",
  'data'=>$save

]); 
}
else
{
  return response()->json([
    'status'=>'false',
    'msg'=>"Spin Not Found. ",

  ]); 
}

}
public function getpercentageCount(Request $request)
{
  $getspin = Spin::where('id',$request->spinner_id)->first();
  if($getspin)
  {
   $checkspin =Spin::where('id',$request->spinner_id)->first();
                  // dd($checkspin->per,$checkspin->per2,$checkspin->per3,$request->percentage);
   $request_spin = null;

   if($checkspin->per == $request->percentage)
   {
    $request_spin = 0;
  }
  elseif ($checkspin->per2 == $request->percentage) {
    $request_spin = 1;
  }
  elseif ($checkspin->per3 ==$request->percentage) {
                  # code
    $request_spin = 2;
  }
  $checkAlogorithm = SpinAlogorithm::where('spinner_id',$request->spinner_id)->get();

  $save =[];
  $per1 =0;
  $per2=0;
  $per3=0;
                // dd($request_spin);
              // dd(count($checkAlogorithm));
  if (count($checkAlogorithm)>0) {
                // dd('sd');
    if (count($checkAlogorithm)==1) {
                  // dd('as');

     foreach ($checkAlogorithm as $key => $value) {
                  // dd('asd');
      $getper1 = $checkspin->per;
      $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper1)->first();
      if($checkAlogorithm1)
      {
        $per1  = $checkAlogorithm1->count;
      }

      $getper2 = $checkspin->per2;
      $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper2)->first();
      if($checkAlogorithm1)
      {
        $per2 = $checkAlogorithm1->count;
      }
      $getper3 = $checkspin->per3;
      $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper3)->first();
      if ($checkAlogorithm1) {
                # code...
        $per3 = $checkAlogorithm1->count;
      }

      $save =[['spinner_id'=>$getspin->id,'per'=>$getspin->per,'count'=>(int)$per1],['spinner_id'=>$getspin->id,'per'=>$getspin->per2,'count'=>(int)$per2],['spinner_id'=>$getspin->id,'per'=>$getspin->per3,'count'=>(int)$per3]];
    }
  }
  elseif (count($checkAlogorithm)==2) {

                    // dd($request_spin);
    foreach ($checkAlogorithm as $key => $value) {
                  // dd($value);
                // dd('dsd');
      $getper1 = $checkspin->per;
      $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper1)->first();

      if ($checkAlogorithm1) {
        $per1 = $checkAlogorithm1->count;
      }
              // dd($per1);
      $getper2 = $checkspin->per2;
      $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper2)->first();
      if ($checkAlogorithm1) {
                # code...
        $per2 = $checkAlogorithm1->count;
      }

      $getper3 = $checkspin->per3;
      $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper3)->first();
              //dd($checkAlogorithm1);
      if ($checkAlogorithm1) {
        $per3 = $checkAlogorithm1->count;
      }



      $save =[['spinner_id'=>$getspin->id,'per'=>$getspin->per,'count'=>(int)$per1],['spinner_id'=>$getspin->id,'per'=>$getspin->per2,'count'=>(int)$per2],['spinner_id'=>$getspin->id,'per'=>$getspin->per3,'count'=>(int)$per3]];
    }
  }
  elseif (count($checkAlogorithm)==3) {
          ///3 ju
                // dd($request_spin);
    foreach ($checkAlogorithm as $key => $value) {
                // dd('aaa');

     $getper1 = $checkspin->per;
     $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper1)->first();
     if ($checkAlogorithm1) {
      $per1 = $checkAlogorithm1->count;
    }
                // dd($per1);


    $getper2 = $checkspin->per2;
    $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper2)->first();
    if ($checkAlogorithm1) {
                # code...
      $per2 = $checkAlogorithm1->count;
    }

    $getper3 = $checkspin->per3;
    $checkAlogorithm1 = SpinAlogorithm::where('spinner_id',$request->spinner_id)->where('per',$getper3)->first();
              //dd($checkAlogorithm1);
    if ($checkAlogorithm1) {
      $per3 = $checkAlogorithm1->count;
    }



    $save =[
     ['spinner_id'=>$getspin->id,'per'=>$getspin->per,'count'=>(int)$per1],
     ['spinner_id'=>$getspin->id,'per'=>$getspin->per2,'count'=>(int)$per2],
     ['spinner_id'=>$getspin->id,'per'=>$getspin->per3,'count'=>(int)$per3]];
     break;
   }

 }
}


      // dd($getspinnerId);
if(count($checkAlogorithm)>0)
{
  return response()->json([
    'status'=>'true',
    'msg'=>"percentageCount Fetch SuccessFully.",
    'data'=>$save

  ]); 
}
else
{
  $getspin = Spin::where('id',$request->spinner_id)->first();

  $save =[['spinner_id'=>$getspin->id,'per'=>$getspin->per,'count'=>0],['spinner_id'=>$getspin->id,'per'=>$getspin->per2,'count'=>0],['spinner_id'=>$getspin->id,'per'=>$getspin->per3,'count'=>0]];
  return response()->json([
    'status'=>'true',
                          // 'msg'=>"percentage Fetch SuccessFully",
    'data'=>$save
  ]); 
}
}
else
{
  return response()->json([
    'status'=>'true',
    'msg'=>"Spin Not Found.",
  ]); 
}
} 

}    