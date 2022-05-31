
<table class="table table-bordered"  id="example">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">UserName</th>
          <th scope="col">Email</th>
          <th scope="col">Mobile No</th>
          <!-- <th scope="col">Wallet Amount</th> -->
          <th scope="col">Date</th>
          <th scope="col">Total Balance</th>
          <th scope="col">KYC Status</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>      
        </tr>
      </thead>
      <tbody>
       @php
          $no=1
        @endphp
       @if(count($users)>0)
        @foreach($users as $user)
        <tr>
          <th scope="row">{{$user->id}}</th>
          <td>{{$user->user_name}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->mobile_no}}</td>
        <!--   <td>{{$user->address}}</td> -->
          <!-- <td>₹{{$user->wallet_amount}}</td> -->
          <td>{{date('d-m-Y',strtotime($user->created_at))}}</td>
          <td>₹ {{$user->balance}}</td>
          <td> @if($user->kyc_status == "verified")
            <span style=" background-color: #0CC27E; color: white ;padding: 2px;border-radius: 5px">Verified</span>
            @elseif($user->kyc_status == "rejected")
            <span style=" background-color: #dc3545; color: white ;padding: 2px;border-radius: 5px">Rejected</span>
            @elseif($user->kyc_status == "padding")
            <span style=" background-color: #fd7e14; color: white ;padding: 2px;border-radius: 5px">Pending</span>
              @elseif($user->kyc_status == "submited")
            <span style=" background-color: #fd7e14; color: white ;padding: 2px;border-radius: 5px">Pending</span>
            @endif</td>
            <td>
             <!--    <label class="switch">
                   <input type="checkbox"  data-id="{{$user->id}}" class="this_status" data-on="Active" data-off="InActive" {{ $user->user_status ? 'checked' : '' }} >
                  <span class="slider"></span>
              <input id="switch-primary-{{$user->id}}" value="{{$user->id}}" name="toggle" type="checkbox" {{ $user->user_status === 1 ? 'checked' : '' }}>
                </label>
 -->    

                 <div class="onoffswitch1">
                  <input type="checkbox" data-id="{{$user->id}}" name="onoffswitch1 toggle_button" class="onoffswitch-checkbox1 toggle-class" id="myonoffswitch1_{{$user->id}}"data-on="Active" data-off="InActive"  {{ ($user->user_status =="1") ? "checked" : ""  }}>
                  <label class="onoffswitch-label1" for="myonoffswitch1_{{$user->id}}">
                      <span class="onoffswitch-inner1"></span>
                      <span class="onoffswitch-switch1"></span>
                  </label>
              </div>
            <!--   @if($user->user_status == "0")
            <span style=" background-color: #dc3545; color: white ;padding: 2px;border-radius: 5px">InActive</span>
            @elseif($user->user_status == "1")
            <span style=" background-color: #0CC27E; color: white ;padding: 2px;border-radius: 5px">Active</span>
            @elseif(empty($user->user_status))
            <span style=" background-color: #dc3545; color: white ;padding: 2px;border-radius: 5px">InActive</span>
            @endif
            </td> -->
          <td>
            <a class="badge badge-success shadow-success" href="{{route('user.edit',$user->id)}}" ><i class="fa fa-edit" ></i></a>
          <a class="badge badge-warning shadow-warning" href="{{route('user.list',$user->id)}}" ><i class="fa fa-eye" ></i> </a>
            <a type="button" class="badge badge-primary shadow-primary addwallet" data-id="{{$user->id}}" data-toggle="modal" data-target="#Addwallet"><i class="fas fa-wallet" style="color: white;"></i>
            </a>
             <a class="badge badge-danger shadow-danger" href="{{route('user.sendnotification',$user->id)}}" type="button" ><i class="fa fa-mail-forward"></i>
             </a>
            </button>
          </td>
        </tr>
        @endforeach
        @else
        <td colspan="12" class="text-center">No Record Found</td>
        @endif
      </tbody>
    </table>
</div>

    
  