<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ticketdetails;
use App\Models\Ticket;
use App\Models\kycverification;
use App\Models\User;
use App\Models\withdraw;
Use \Carbon\Carbon;
use DB;

class TicketdetailsController extends Controller
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
     * @return \Illuminate\Http\Responsefirst
     */
    public function getTicketDetails(Request $request)
    {
        $TicketDetails = ticketdetails::where('user_id',$request->id)->where('ticket_id', $request->ticket_id)->get();
        

        
        $getUser = User::where('id',$request->id)->first();            
        
        if($request->hasFile('attechment'))
        {

            $data1 = new ticketdetails;
            $data1->user_id = $request->id;
            $data1->ticket_id = $request->ticket_id;
            $data1->message = $request->message;
            $fileName = time().'.'.$request->attechment->extension();  
            $request->attechment->move(public_path().'/upload/', $fileName);
            $data1->attechment = $fileName;
            $data1-> save();
            // dd($data1);
        }
        else
        {
                // dd('else');
         $data1 = new ticketdetails;
         $data1->user_id = $request->id;
         $data1->ticket_id = $request->ticket_id;
         $data1->message = $request->message;
         $data1->attechment = $request->attechment;
         $data1-> save();
     }
     $data1 = ticketdetails::where('user_id',$request->id)->where('ticket_id', $request->ticket_id)->get();
     $getUser = User::where('id',$request->id)->first();

     $path=null;
     if($getUser->image)
     {

        $path = env('APP_URL').'/public/upload/'.$getUser->image;
    }


    $save =[];
    foreach ($data1 as $value)
    {

       $month = $value->created_at->format('M');
               // $time = $value->created_at->format('H:i:s');
       $date = Carbon::now();


       array_push($save,['id'=>$value->id,'user_id'=> $value->user_id,'ticket_id'=>$value->ticket_id,'message'=>$value->message,'created_at'=>$value->created_at,'updated_at'=>$value->updated_at,'month'=>$month,'time'=>$date,'image'=>$path,'attechment'=>$value->attechment ]);
   }
   return response()->json([
    'status' => "true",
    'msg' => "TicketDetails Fetch SuccessFully.",
    "data" =>$save
]);
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

    public function storekycdocument(Request $request)
    {  
       // dd($request->all());
        $file1;

        $user = User::where('id',$request->user_id)->first();
        
        if($user)
        {
            $checkUser = kycverification::where('user_id',$user->id)->first();
            if($checkUser){
                if($request->has('document')){
                    foreach ($request->document as $key => $file)
                    {
                       $name = date('mdYHis').'_'.rand().$file->getClientOriginalName();;
                       $imgName[$key] =$name;
                       $file->move('upload/kyc',$name);
                   }
                   $imgName = implode(',',$imgName);
                   if($checkUser->document != ''){
                    $oldimage = $imgName.','.$checkUser->document;
                }else{
                    $oldimage = $imgName;
                }
                $file1 = kycverification::find($checkUser->id);
                $file1->user_id = $request->user_id;
                $file1->document_type =$request->type; 
                $file1->document = $oldimage;
                $file1->save();

            }
        }else{
            if($request->has('document')){
                foreach ($request->document as $key => $file)
                {
                   $name = date('mdYHis').'_'.rand().$file->getClientOriginalName();;
                   $imgName[$key] =$name;
                   $file->move('upload/kyc',$name);
               }
               // dd($imgName);
               $imgName = implode(',',$imgName);

               $file1 = new kycverification;
               $file1->user_id = $request->user_id;
               $file1->document_type =$request->type; 
               $file1->document = $imgName;
               $file1->save();
           }
       }
       if($file1){
           $getUserName = User::where('id',$request->user_id)->first();
           $getUserName->user_name =$request->user_name;
           $getUserName->kyc_status = 'submited';
           $getUserName->save();

       }



       return response()->json([
        'status' => "true",
        'msg' => "kycverification Store SuccessFully.",

    ]);

   }


   
}
public function getAlltimeWinner()
{
  $collection = User::orderBy('winning_amount','DESC')->select('id','name','winning_amount')->take(3)->get();

  return response()->json([
    'status' => "true",
    'msg' => "First Record of Winning Amount Fecth SuccessFully.",
    "data" => $collection

]);   
}
public function Displayticketdetails(Request $request)
{

    $TicketDetails = ticketdetails::where('ticket_id', $request->ticket_id)->get();
    


    $save_all =[];
    foreach ($TicketDetails as $value) 
    {
     $getUser = User::where('id',$value->user_id)->first();
     $path=null;
     if($getUser->image)
     {

        $path = env('APP_URL').'/public/upload/'.$getUser->image;
    }
    $user_type = null;
    if($value->user_id == '1')
    {
        $user_type ='admin';
    }
    else
    {
                // dd('dsd');  
        $user_type ='user';
    }
    $attechmentPath = null;
    if ($value->attechment) 
    {

        $attechmentPath = env('APP_URL').'/public/upload/'.$value->attechment;
    }


    $month = $value->created_at->format('M');
    array_push($save_all,['id'=>$value->id,'user_id'=> $value->user_id,'ticket_id'=>$value->ticket_id,'message'=>$value->message,'created_at'=>$value->created_at,'updated_at'=>$value->updated_at,'month'=>$month,'attechment'=>$attechmentPath,'image'=> $path ,'message_type'=>$user_type]);

}


return response()->json([
    'status' => "true",
    'msg' => "Display Ticket Details SuccessFully.",
    "data" => $save_all

]);

} 

public function getMinimumMaximum(Request $request)
{
    $getminmax = withdraw::first();
    return Response()->json([
        'status'=>"true",
        'msg'=>"Withdraw Minimum & Maximum Fetch Successfully.",
        'data'=>$getminmax
    ]); 
}  
}
