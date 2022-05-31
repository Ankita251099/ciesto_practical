<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spin;
use App\Models\Ticket;
use App\Models\Video;
use App\Models\User;
use App\Models\Faqs;
use App\Models\transaction;
use App\Models\Terms_Condition;
use App\Models\Privacy;
use App\Models\referencePolicy;
use App\Models\splashscreen;
use App\Models\ticketdetails;
use App\Models\version;
use App\Models\Userwithdrawallimit;
use Illuminate\Support\Facades\Validator;
Use \Carbon\Carbon;
use DB;
use Auth;

// use App\Models\helpdesk;


class SpinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Spin::all();
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
    public function show(Request $request)
    {
        $getdata = Spin::get();
        if(count($getdata) > 0)
        {
          $save = [];
          foreach ($getdata as $key => $value) {
            $newhours = $value->hours.":00".":00";
            date_default_timezone_set('Asia/Kolkata');
            $current_date =  date('Y-m-d H:i:s');
            $date_time =  date('Y-m-d H:i:s ',strtotime($value->date_time));
            $date1=date_create($current_date);
            $date2=date_create($value->date_time);
            $diff = date_diff($date1,$date2);
            $final = date_interval_format($diff,'%y:%m:%d:%h:%i:%s');
            $new_time = date('H:i:s',strtotime($newhours));
             $time = explode(':', $final);
             $time_seconds = $time[0]*31536000 + $time[1]*2592000 + $time[2]*86400 + $time[3] * 3600 + $time[4] * 60 + $time[5];
             $valueminiutes = (int)$value->hours * 60;
             $valuesecond = $valueminiutes * 60;
        
            if($value->date_time == null)
            {
              $diffsecond = 0;
            }
            else
            {
              if($valuesecond > $time_seconds)
              {
                $diffsecond  = $valuesecond - $time_seconds;
              }
              else
              { 
                $diffsecond = 0;
              }
            }
            array_push($save,['id'=> $value->id,'amount'=>$value->amount,'discount_amount'=>$value->discount_amount,'price'=>$value->price,'price1'=>$value->price1,'price2'=>$value->price2,'price3'=>$value->price3,'price4'=>$value->price4,'price5'=>$value->price5,'price6'=>$value->price6,'price7'=>$value->price7,'price8'=>$value->price8,'price9'=>$value->price9,'count'=>$value->count,'count'=>$value->count,'count2'=>$value->count2,'count3'=>$value->count3,'per'=>$value->per,'per2'=>$value->per2,'per3'=>$value->per3,'hours'=>$value->hours,'remaining_time'=> $diffsecond ,'created_at'=>$value->created_at,'updated_at'=>$value->updated_at]);


          }
            return response()->json([
                'status' => "true",
                'msg' => "Spin Details Fetch Successfully.",
                'data' => $save
            ]);
        }
        else{
            return response()->json([
                'status' => "false",
                'msg' => "Spin Details Not Found.",
            ]);
        }

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

    public function addTicket(Request $request)
    
    {
        $addmsg =Ticket::where('user_id',$request->user_id)->where('issue_type','wallet and payment')->first();
        
        if($request->hasFile('attechment')){
        $ticket=new Ticket;
        $ticket->user_id=$request->user_id;
        $ticket->issue_type=$request->issue_type;

        $fileName = time().'.'.$request->attechment->extension(); 
        $request->attechment->move(public_path().'/upload/', $fileName);

        $ticket->attechment = $fileName;
    
        $ticket->issue=  $request->issue;
        $ticket->save();
        }
        else
        {

        $ticket=new Ticket;
        $ticket->user_id=$request->user_id;
        $ticket->attechment = $request->attechment;
        $ticket->issue=  $request->issue;

        $ticket->save();


        } 
            if($request->issue_type == 'wallet and payment')
                {
                    $add = new ticketdetails;
                    $add->ticket_id =$ticket->id;
                    $add->user_id = '1';
                    $add->message = "This is update you that withdrawals will be made through the bank's proceess and sometimes your withdrawal might take a maximum of 24-72 working hours to get credited in your bank account as per the banking NEFT/IMPS procedure.";
                    $add->save();
                    $add=new ticketdetails;
                  $add->ticket_id=$ticket->id;
                  $add->user_id=$request->user_id;
                  $add->message = $ticket->issue;
                  $add->attechment = $ticket->attechment;
                  if($ticket->attechment == null)
                  {
                    $add->attechment = null;
                  }
                  $add->save();
                }
                else
                {
                    $add = new ticketdetails;
                    $add->ticket_id =$ticket->id;
                    $add ->user_id ='1';
                    $add->message = "Thank you for contacting our support system, we will get back to you soon.";
                    $add->save();
                    $add=new ticketdetails;
                  $add->ticket_id=$ticket->id;
                  $add->user_id=$request->user_id;
                  $add->message = $ticket->issue;
                  $add->attechment = $ticket->attechment;
                  if($ticket->attechment == null)
                  {
                    $add->attechment = null;
                  }
                  $add->save();
                 
                }
             
        return response()->json([
                        'status' => "true",
                        'msg' => "Ticket Add SuccessFully.",
                        "data" => $ticket
                    ]);
    }
    public function getTicket(Request $request)
    { 
        $tickets=Ticket::where('user_id',$request->user_id)->where('status',$request->status)->get();
        $save_all=[];

        foreach ($tickets as $value) {
         $month = $value->created_at->format('M');
         // $all = $value->response_time;
         // dd($all);
         if ($value->response_time== null)
        {
            $responsemonth = null;
        }
        else
        {

          $responsemonth =  date("M", strtotime($value->response_time));        

        }
         array_push($save_all,['id'=>$value->id,'user_id'=> $value->user_id,'issue_type'=>$value->issue_type,'issue'=>$value->issue, 'status'=>$value->status,'created_at'=>$value->created_at,'updated_at'=>$value->updated_at,'response_time'=>$value->response_time,'response_time_month'=>$responsemonth,'month'=>$month]);
        }
        $reversed = array_reverse($save_all);
        if($save_all)
        {
            return response()->json([
                        'status' => "true",
                        'msg' => "Ticket Fetch SuccessFully.",
                        "data" => $reversed
                    ]);
        }
        else
        {
            return response()->json([
                        'status' => "false",
                        'msg' => "No Ticket Found",
                    ]);
        }
    }

     public function VideoGet(Request $request)
     {
        $videos=Video::all();
        if($videos)
        {    
        return Response()->json([
            'status'=>"true",
            'msg'=>"Video Fetch Successfully.",
            "data"=>$videos
        ]);
        }
        else
        {
            return Response()->json([
            'status'=>"false",
            'msg'=>" No Video Found.",
        ]); 
        }
     }

     public function GetLeaderboard(Request $request)
     {
        if($request->type == 'alltime')
        {
            $collection = User::orderBy('winning_amount','DESC')->where('kyc_status','verified')->take(100)->get();
            // dd($collection);
            $save_all=[];
            foreach ($collection as $value) 
            {    
                $path=null;
                if($value->image)
                {
                    $path = env('APP_URL').'/public/upload/'.$value->image;
                }
                array_push($save_all, ['id'=> $value->id,'referal_id'=>$value->referal_id,'name'=>$value->name, 'email'=>$value->email,'address'=>$value->address,'mobile_no'=>$value->mobile_no,'balance'=>$value->balance,'winning_amount'=>(string)$value->winning_amount,'image'=>$path,'referal_code'=>$value->referal_code,'created_at'=>$value->created_at,'updated_at'=>$value->updated_at]);
            }

            return Response()->json([
                'status'=>"true",
                'msg'=>" Rank Found.",
                'data'=>$save_all
        ]); 
        }
        elseif ($request->type == "thisweek")
         {
             $oldDate = date('Y-m-d h:i:s', strtotime('-7 days'));
             $currentDate = date('Y-m-d h:i:s');
            $getUserDetails =[];

            $users = DB::table('transactions')
                    ->join('users', 'transactions.user_id', '=', 'users.id')
                    ->where('kyc_status', 'verified')
                    ->where('type','wining')
                    ->where('transactions.created_at','>=',$oldDate)
                    ->where('transactions.created_at','<=',$currentDate)
                    ->select('transactions.amount','transactions.user_id','users.name','users.mobile_no','users.email','users.image')
                    ->groupBy('transactions.user_id')
                    ->take(50)
                    ->get();

                    // dd($users);
                    $count = count($users);


                    $amount =[];
                   $data = [];
                    $userId =[];


                    foreach ($users as  $key => $value) {

                     $getTotalAmount = transaction::where('user_id',$value->user_id)->where('type','wining')->sum('amount');

                     $amount [$key] = ['getTotalAmount' => $getTotalAmount , 'user_id'=>$value->user_id]; 
                     // $userId[$key] = $value->user_id;

                        $path=null;
                    if($value->image)
                        {
                            // dd('addd');
                        $path = env('APP_URL').'/public/upload/'.$value->image;
                        }
                       
                     $data[$key] = ['amount' => $value->amount,'user_id' => $value->user_id,'name' => $value->name,'mobile_no' => $value->mobile_no,'email' => $value->email,'image' => $path,'winning_amount' => $amount[$key]];
            }
            // dd($amount);
            // dd($amount);
///            rsort($amount);
                /*rsort($data);
                $arrlength = count($data);
                for($x = 0; $x < $arrlength; $x++) {
                   $data[$x];
                  
                }*/

            return response()->json([
                'status'=>"true",
                'msg'=>"This Week Record Fetch Successfully.",
                'data'=>$data,
            ]);         
     }
     elseif($request->type == "thismonth"){
         $oldDate = date('Y-m-d h:i:s', strtotime('-31 days'));
         // dd($oldDate);
             $currentDate = date('Y-m-d h:i:s');
            $getUserDetails =[];
            $users = DB::table('transactions')
                    ->join('users', 'transactions.user_id', '=', 'users.id')
                    ->where('kyc_status','verified')
                    ->where('type','wining')
                    ->where('transactions.created_at','>=',$oldDate)
                    ->where('transactions.created_at','<=',$currentDate)
                    ->select('transactions.amount','transactions.user_id','users.name','users.mobile_no','users.email','users.image')
                    ->groupBy('transactions.user_id')
                    ->take(20)
                    ->get();

                    // dd($users);

                    $count = count($users);
                   
                   $data = [];
                    foreach ($users as $value) {
                
                     $getTotalAmount = transaction::where('user_id',$value->user_id)->where('type','wining')->sum('amount');
                        $path=null;
                    if($value->image)
                        {
                            // dd('addd');
                        $path = env('APP_URL').'/public/upload/'.$value->image;
                        } 

                     $data[] = ['amount' => $value->amount,'user_id' => $value->user_id,'name' => $value->name,'mobile_no' => $value->mobile_no,'email' => $value->email,'image' => $path,'winning_amount' =>(string)$getTotalAmount];
            }
            // dd($getTotalAmount);

                rsort($data);
                $arrlength = count($data);
                for($x = 0; $x < $arrlength; $x++) {
                   $data[$x];
                  
                }

            return response()->json([
                'status'=>"true",
                'msg'=>"This month Record Fetch Successfully.",
                'data'=>$data
            ]);
     }


}
    
      public function getTerms(Request $request)
     {
            $terms = Terms_Condition::first();
             return Response()->json([
            'status'=>"true",
            'msg'=>"Terms & Conditions Fetch Successfully.",
            'data'=>$terms
        ]);        
            
     }
      public function getPolicy(Request $request)
     {
            $policy = privacy::first();
             return Response()->json([
            'status'=>"true",
            'msg'=>"Privacy Policy Fetch Successfully.",
            'data'=>$policy
        ]);        
            
     }
      public function getreference(Request $request)
     {
            $reference = referencePolicy::first();
             return Response()->json([
            'status'=>"true",
            'msg'=>"Reference Policy Fetch Successfully.",
            'data'=>$reference
        ]);        
            
     }
     public function getsplashscreen(Request $request)
     {
            $getscreen = splashscreen::first();
            // dd($getscreen);
            if($getscreen == null)
            {
            return Response()->json([
            'status'=>"true",
            'msg'=>"Splash Screen Fetch Successfully.",
            'data'=>$getscreen
            ]);        
                 // dd('asd');
            }
            elseif($getscreen->image)
            {
                // dd('dff');
                $path = env('APP_URL').'/public/upload/image/'.$getscreen->image;
                # code...
            }
            $data=['id'=>$getscreen->id,'image'=>$path,'created_at'=>$getscreen->created_at,'updated_at'=>$getscreen->updated_at];
           
             return Response()->json([
            'status'=>"true",
            'msg'=>"Splash Screen Fetch Successfully.",
            'data'=>$data
        ]);        
           
            
     }
     public function spinPrice(Request $request)
     {
         $rules = array(
            'user_id' => 'required',
        );
        $messages = array(
            'user_id.required' => 'Please enter user id.'  
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            $msg = $validator->messages();
            return ['status' => "false",
            'msg' => $msg];
        }
           
        $getSpinName = User::where('id',$request->user_id)->first();
        if($getSpinName)
        {

        if($request->type == "play" )
            {
                     

                    $user1 = new transaction;
                    $user1->user_id = $request->user_id;
                    $user1->amount = $request->amount;
                    $user1->bonus = $request->bonus_amount;
                    // $user1->is_paid = "1";
                    $user1->type =  $request->type;

                    $user1->save();
  
                    
                    if($request->is_winning == 0)
                    {
                      $getSpinName->bonus = $getSpinName->bonus - $request->bonus_amount;
                      $getSpinName->balance = $getSpinName->balance - $request->amount; 
                      $getSpinName->save();

                    
                    }
                    elseif($request->is_winning == 1)
                    {

                     
                        $getSpinName->bonus = $getSpinName->bonus - $request->bonus_amount;
                        $getSpinName->winning_amount = $getSpinName->winning_amount - $request->amount; 
                        $getSpinName->save();
                     
                    }
                $userdata =  User::find($user1->user_id);
                $user1->name .=$getSpinName->name;
                $user1->balance.=$userdata->balance;
                $save =['user_id'=>$request->user_id,'amount'=>$request->amount,'type'=>$request->type,'name'=>$getSpinName->name,'balance'=>$userdata->balance,'bonus'=>$getSpinName->bonus,'winning_amount'=>$getSpinName->winning_amount];
                                
            }
            return response()->json([
                'status' => "true",
                'msg' => "Total Spin Price SuccessFully.",
                "data" => $save
            ]);
        }   
        else{
            return response()->json([
            'status' => "false",
            'msg' => "User not found.",
        ]);

        }
     }

     public function getFaq(Request $request)
     {
        $getFaq = Faqs::all();
        if($getFaq)
        {
            return response()->json([
                'status' => "true",
                'msg' => "Faqs Fetch SuccessFully.",
                "data" => $getFaq
            ]);
        }
        else
        {
         return response()->json([
            'status' => "false",
            'msg' => "Faqs not found.",
        ]);
        }

     }
      public function forcecUpdate(request $request)
    {
        $checkUpdate  = version::first();
        if($checkUpdate)
        {
        $save_all = ['id'=>$checkUpdate->id,'version'=>$checkUpdate->version,'url'=>$checkUpdate->url,'created_at'=>$checkUpdate->created_at,'updated_at'=>$checkUpdate->updated_at];
         return Response()->json([
            'status'=>"true",
            'msg'=>"Force Update Fetch Successfully.",
            'data'=>$save_all
        ]);        
        }
        else
        {
             return Response()->json([
            'status'=>"false",
            'msg'=>"No Record Found."
        ]);  
        }

    }

    public function withdrawAmount(request $request)
    {
      $getUser = User::where('id',$request->user_id)->first();
      $getwithdrawal = Userwithdrawallimit::where('user_id',$request->user_id)->first();
        if($getUser)
        { 
          if($getwithdrawal == null)
          {
           date_default_timezone_set('Asia/Kolkata');
          $current_date =  date('Y-m-d H:i:s');
          $add =  new Userwithdrawallimit;
          $add->user_id = $request->user_id;
          $add->date = $current_date;
          $add->save();  
          }
          else
          {
           date_default_timezone_set('Asia/Kolkata');
            $current_date =  date('Y-m-d H:i:s');
          $user1= Userwithdrawallimit::where('user_id',$request->user_id)->update(['date'=> $current_date]);
          }

        if($request->type == "withdraw" )
            {

                    $user1 = new transaction;
                    $user1->user_id = $request->user_id;
                    $user1->amount = $request->amount;
                    $user1->type =  $request->type;
                    $user1->save();
                    $getUser->winning_amount = $getUser->winning_amount - $request->amount; 
                      $getUser->save(); 
            }
            // dd($getwithdrawal->date);

            $save =['user_id'=>$request->user_id,'amount'=>$request->amount,'type'=>$request->type,'name'=>$getUser->name,'balance'=>$getUser->balance,'winning_amount'=>$getUser->winning_amount, 'response_time' =>$current_date];
         return response()->json([
            'status'=>"true",
            'msg'=>"Withdraw Fetch Successfully.",
            'data'=>$save
        ]);       
    }
      return response()->json([
            'status'=>"false",
            'msg'=>"User Not Found."
        ]);      
}

  public function checkwithdrawtime(Request $request)
  {
     $getwithdrawal = Userwithdrawallimit::where('user_id',$request->user_id)->first();

     if($getwithdrawal)
     {
      $new_time = date('Y-m-d H:i:s', strtotime('+3 hours',strtotime($getwithdrawal->date)));
      
      date_default_timezone_set('Asia/Kolkata');
      $current_date =  date('Y-m-d H:i:s'); 
      
      if($new_time > $getwithdrawal->date)
      {
        if($new_time > $current_date)
        {
            $diff1= strtotime($new_time) - strtotime($current_date);
            $hours= gmdate("H:i:s", $diff1);
         $save = ['is_withdrawallimts'=> '1', 'remaining_time'=>$diff1];
        }
        else
        {
        $save = ['is_withdrawallimts'=>'0','remaining_time'=>'0']; 
        }
      }
      else  
      {
        $save = ['is_withdrawallimts'=>'0','remaining_time'=>'0']; 
      }
      
      return response()->json([
            'status'=>"true",
            'msg'=>"Withdrawal Limit Check SuccessFully.",
            'data'=>$save
        ]);

     }
     else
     {
        return response()->json([
            'status'=>"false",
            'msg'=>"User Not Found."
        ]);  
     }

  }


}
