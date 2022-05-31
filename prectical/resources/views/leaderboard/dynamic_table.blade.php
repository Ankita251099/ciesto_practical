<div class="card-content collapse show">
                <div class="card-body">

 <table class="table table-bordered" id="example">
     
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">UserName</th>
          <th scope="col">Email</th>
          <th scope="col">Mobile No</th>
          <th scope="col">Winning Amount</th>      
        </tr>
      </thead>
      <tbody>
       @php
          $no=1;
         
        @endphp
       @if(count($users)>0)
        @foreach($users as $user)
        <tr>
          <th>{{$no}}</th>
          <td>{{isset($user['name'])? $user['name'] :''}}</td>
          <td>{{isset($user['email'])? $user['email'] :''}}</td>
          <td>{{isset($user['mobile_no'])? $user['mobile_no'] :''}}</td>
          <td>₹{{isset($user['winning_amount'])? $user['winning_amount'] :''}}</td>

          
        </tr>
        @php
          $no++
        @endphp
        @endforeach

        @else
        <td colspan="6" class="text-center">No Record Found</td>
        @endif
      </tbody>
      
    </table>
  </div>
</div>