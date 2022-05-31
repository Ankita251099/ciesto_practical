<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
          $data=new User;
    	// dd($request->all());
          $data->name=$request->name;
          $data->email=$request->email;
          $data->password=Hash::make($request->password);
          $data->save();
          return redirect()->to('/login');
}
}
