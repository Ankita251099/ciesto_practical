
  <!-- <div class="card-body"> -->
    <!-- <div class="row ">
        <label>KYC Status:</label>
        <div class="form-group col-md-2">
                       <select name="status" required="" id="status_active" class="select2 form-control status">
                           <option  selected="" value="">~~SELECT~~</option>
                            <option value="padding">Padding</option>
                           <option value="rejected">Rejected</option>
                           <option value="verified">Verified</option>
                       </select>
                    </div>
                    <div class="form-group col-md-2">
                      
                  <button type="button" class="btn btn-danger btn-lg filter">Filter</button>
                    </div>
                  </div>

 -->
  
        <div class="row">
      
     <div class="form-group col-md-12">
                  <a href="{{route('user.view')}}" type="button" class="btn btn-primary btn-lg filter pull-right" >View All User</a>
                    </div>
    </div>

               <div class="user_table">
                     <table class="table table-bordered"  id="example1">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">UserName</th>
          <th scope="col">Email</th>
          <th scope="col">Mobile No</th>
          <th scope="col">Wallet Amount</th>
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
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
        <!--   <td>{{$user->address}}</td> -->
          <td>{{$user->mobile_no}}</td>
          <td>{{$user->wallet_amount}}</td>
          <td> @if($user->kyc_status == "verified")
            <span style=" background-color: #0CC27E; color: white ;padding: 2px;border-radius: 5px">Verified</span>
            @elseif($user->kyc_status == "rejected")
            <span style=" background-color: #dc3545; color: white ;padding: 2px;border-radius: 5px">Rejected</span>
            @elseif($user->kyc_status == "padding")
            <span style=" background-color: #fd7e14; color: white ;padding: 2px;border-radius: 5px">Padding</span>
            
            @endif</td>
            <td>
                <label class="switch">
                   <input type="checkbox"  data-id="{{$user->id}}" class="this_status" data-on="Active" data-off="InActive" {{ $user->user_status ? 'checked' : '' }} >
                  <span class="slider"></span>
                </label>
           <!--    <input id="switch-primary-{{$user->id}}" value="{{$user->id}}" name="toggle" type="checkbox" {{ $user->user_status === 1 ? 'checked' : '' }}>
 -->
            </td>
          <td>
           
            <a href="{{route('kyc.create',$user->id)}}"type = "button" class="btn btn-danger">View Kyc</a>
          </td>


          
        </tr>
        @endforeach
        @else
        <td colspan="6" class="text-center">No Record Found</td>
        @endif
      </tbody>
      
    </table>
</div>
    
                    <!-- </div> -->
  
<!-- </div> -->
