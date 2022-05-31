<table class="table table-bordered" id="example">
      <thead>
        <tr>
          <th scope="col">#</th>
          <!-- <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Mobile No</th> -->
          <th scope="col">Date</th>
          <th scope="col">Transaction Amount</th>
          <!-- <th scope="col">Payment Mode</th> -->
          <th scope="col">Type</th>
          <th scope="col">Status</th>
                
        </tr>
      </thead>
      <tbody>
      @php
      $no=1
      @endphp
      @if(count($transactions)>0)
      @foreach($transactions as $transaction)
      <tr>
        <td>{{$no++}}</td>
          <!-- <td>{{$transaction->user_name['name']}}</td>
          <td>{{$transaction->user_name['email']}}</td>
          <td>{{$transaction->user_name['mobile_no']}}</td> -->
          <td>{{date('d-m-Y',strtotime($transaction->created_at))}}</td>
          <td>₹ {{$transaction->amount}}</td>
          <td>{{$transaction->type}}</td>
          <td>
             @if($transaction->is_paid == 1)
            <span style=" background-color: #0CC27E; color: white ;padding: 2px;border-radius: 5px">Successful</span>
            @else
            <span style=" background-color: #dc3545; color: white ;padding: 2px;border-radius: 5px">Failed</span>
            @endif
          </td>
          
      
      </tr> 
      @endforeach
      @else
        <td colspan="12" class="text-center">No Record Found</td>
      
      @endif 
      
      </tbody>
      
    </table>