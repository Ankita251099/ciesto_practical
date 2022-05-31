<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use App\Models\transaction;
use Carbon\Carbon;
use DB;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users =User::all(); 
        // $users = DB::table('users')->get()->toArray();

        $users = User::where('id','!=', Auth::user()->id)->get();

        // dd($users);
        // $array = [];
        // foreach ($users  as $key =>  $user) {
        //   if($user->name != 'admin'){
        //       $array[$key] = $user;
        //   }
        // }
        // dd($array);
        return view('Users.view',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$id)
    {
        // dd('sdsd');

        $users = User::find($id);
        $totalbalance  = transaction::where('user_id',$id)->where('type','deposite')->sum('amount');
        $totalwithdraw  = transaction::where('user_id',$id)->where('type','withdraw')->sum('amount');

        // dd($totalbalance);
        $transactions = transaction::where('user_id',$id)->get();
        
        return view('Users.viewuser', compact('users','transactions','totalbalance','totalwithdraw'));
    }

     public function changedate(Request $request)
    {
        // dd($request->all());


        if($request->date ==!null && $request->id ==!null){
          $transactions = transaction::where('created_at', 'like', $request->date.'%')->where('user_id',$request->id)->get();
          // dd($transactions);
        }
        else
        {
            $transactions = transaction::all();
        }


    $allData = view('Users.transactionhistroy', compact('transactions'))->render();
    // dd($allData);
    $data=['data' => $allData];
    // dd($data);
    return Response()->json($data);

  }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd('ada');
        $users = User::find($request->id);
        $users->balance = $request->balance + $users->balance;
        $users->save();
        // dd($users);
        return redirect()->route('user.view');
        // ]);
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
        $users = User::find($id);
        return view('Users.edit',compact('users'));
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
        // dd($request->all());
          $request->validate([
            'user_name'=> 'required',
            'email'=>'required',
        ]);
        $users = User::find($id);
        $users->user_name = $request->user_name;
        $users->email = $request->email;
        $users->save();
        return redirect()->route('user.view')->with('success','User List updated successfully');
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

    public function sendnotification($id)
    {
        //
        $userData = User::where('id', $id)->first();
        return view ('Users.sendnotification',compact('userData'));
    }

    public function storenotification(Request $request)
    {
         $request->validate([
            'type'=> 'required',
            'image'=>'required',
            'message'=>'required|max:100',
        ]);
        // $testData = User::where('id',$id)->first();
        //
            // dd($request->all());
        $data = new Notification;
          $data->user_id = $request->user_id;
            $data->type = $request->type;
           if($request->has('image'))
        {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/upload/notification');
            $image->move($destinationPath, $name);
         } 
            $data->image = $name;
            $data->message = $request->message;
            $data->save();
            return redirect()->route('notification.index')->with('success','Notification Created successfully');

     
    }
     public function status(Request $request)
    {
        // dd($request->all());

        
        if($request->data != null &&  $request->date != null ){
          $users = User::where('created_at', 'like', $request->date.'%')->where('kyc_status',$request->data)->get();
        }elseif($request->date != null){
          $users = User::where('created_at', 'like', $request->date.'%')->get();
        }elseif ($request->data != null) {
            $users= User::where('kyc_status',$request->data)->get();             
        }else{
                 $users= User::all();
        }


    $allData = view('Users.user_table', compact('users'))->render();
    // dd($allData);
    $data=['data' => $allData];
    //dd($data);
    return Response()->json($data);

  }
    public function change_status(Request $request){
        // dd($request->all());
        $users = User::find($request->id);
        if($request->user_status == '1'){
            $users->user_status = '1';
        }elseif($request->user_status == '0'){
            $users->user_status = '0';
        }
        $users->save();
        

        return response()->json([
            'msg' => "Status Changed Successfully"
        ]);
    }
          
}