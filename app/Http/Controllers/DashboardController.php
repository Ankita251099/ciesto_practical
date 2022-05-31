<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\helpdesk;
Use App\Models\Ticket;
use App\Models\transaction;
use App\Models\kycverification;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd('asd');

        return view('dashboard.dashboard');

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
     public function datefilter(request $request)
    {
        
            if($request->from_date && $request->to_date)     
            {

             $alldate = User::whereBetween('created_at',[$request->from_date." 00:00:00",$request->to_date." 00:00:00"])->get('created_at');

             dd($alldate);
             $total_ticket= Ticket::whereBetween('created_at',[$request->from_date." 00:00:00",$request->to_date." 00:00:00"])->count();
              $total_open= Ticket::whereBetween('created_at',[$request->from_date." 00:00:00",$request->to_date." 00:00:00"])->where('status','open')->count();
               $total_close= Ticket::whereBetween('created_at',[$request->from_date." 00:00:00",$request->to_date." 00:00:00"])->where('status','close')->count();
                // $total_kyc= User::whereBetween('created_at',[$request->from_date." 00:00:00",$request->to_date." 00:00:00"])->where('kyc_status','=','padding')->orWhere('kyc_status','=','verified')->count();
                $kyc_pendding= User::whereBetween('created_at',[$request->from_date." 00:00:00",$request->to_date." 00:00:00"])->where('kyc_status','=','padding')->count();
                $kyc_verified= User::whereBetween('created_at',[$request->from_date." 00:00:00",$request->to_date." 00:00:00"])->where('kyc_status','=','verified')->count();
                $total_kyc= $kyc_pendding + $kyc_verified; 
                $total_receive = transaction::whereBetween('created_at',[$request->from_date." 00:00:00",$request->to_date." 00:00:00"])->where('type','deposite')->sum('amount');
                $total_withdraw = transaction::whereBetween('created_at',[$request->from_date." 00:00:00",$request->to_date." 00:00:00"])->where('type','withdraw')->sum('amount');
                $total_save = $total_receive - $total_withdraw;
            }
            // dd($alldate);
         $allData = view('dashboard.ticket', compact('total_ticket','total_open','total_close'))->render();
         $allData1=view('dashboard.kyc',compact('kyc_pendding','kyc_verified','total_kyc'))->render();
         $allData2=view('dashboard.payment',compact('total_receive','total_withdraw','total_save'))->render();
         $allData3 = view('dashboard.userchart',compact('alldate'))->render();
        $data=['data' => $allData ,'data2'=> $allData1 ,'data3' =>$allData2,'data4'=>$allData3];
        return Response()->json($data);
    }
}
