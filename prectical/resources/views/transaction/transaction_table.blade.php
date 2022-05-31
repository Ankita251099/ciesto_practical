<table class="table table-bordered" id="example">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Date</th>
          <th scope="col">Name</th>
          <th scope="col">Mobile No</th>
          <th scope="col">Added Amount</th>
          <!-- <th scope="col">Bank name</th> -->
          <th scope="col">Status</th>
          <th scope="col">Action</th>
          
        </tr>
      </thead>
      <tbody>
        @php
          $no=1
        @endphp
       @if(count($transactions)>0)
        @foreach($transactions as $transaction )
        <tr>
          <th scope="row">{{$no}}</th>
          <td>{{date('d-M-Y',strtotime($transaction->created_at))}}</td>
          <td>{{$transaction->user_name['name']}}</td>
          <td>{{$transaction->user_name['mobile_no']}}</td>
          <td>₹{{$transaction->amount}}</td>
        
          <td> @if($transaction->is_paid== 1)    
            <span style=" background-color: #0CC27E; color: white ;padding: 2px;border-radius: 5px">Successful</span>
            @else
            <span style=" background-color: #dc3545; color: white ;padding: 2px;border-radius: 5px">Failed</span>
           
            @endif
          </td>

          <td>
           <!--  @if($transaction->status=="pending")
             <a class="badge badge-success shadow-success this_verified" data-url="{{route('transaction.paid')}}" data-id="{{$transaction->id}}"><i class="fa fa-check" ></i> </a>
            <a class="badge badge-warning shadow-waring this_unpaid" data-id="{{$transaction->id}}" data-url="{{route('transaction.unpaid')}}" ><i class="fa fa-times"></i> </a>
           <a class="badge badge-danger shadow-danger this_destroy"  data-url="{{route('transaction.delete',$transaction->id)}}" ><i class="fa fa-trash-o"></i> </a>
           @elseif($transaction->status =="unpaid")
           <a class="badge badge-success shadow-success this_verified" data-url="{{route('transaction.paid')}}" data-id="{{$transaction->id}}"><i class="fa fa-check" ></i> </a>
            <a class="badge badge-warning shadow-waring this_unpaid" data-id="{{$transaction->id}}" data-url="{{route('transaction.unpaid')}}" ><i class="fa fa-times"></i> </a>
           <a class="badge badge-danger shadow-danger this_destroy"  data-url="{{route('transaction.delete',$transaction->id)}}" ><i class="fa fa-trash-o"></i> </a>
           @elseif($transaction->status=="paid")
            <a class="badge badge-success shadow-success this_verified" data-url="{{route('transaction.paid')}}" data-id="{{$transaction->id}}"><i class="fa fa-check" ></i> </a> -->
           <!--  @endif -->
            <a class="badge badge-danger shadow-danger this_destroy"  data-url="{{route('transaction.delete',$transaction->id)}}" ><i class="fa fa-trash" style="color: white;"></i> </a>
          </td>
        </tr>
        @php
          $no++
        @endphp
        @endforeach
        @else
        <td colspan="8" class="text-center">No Record Found</td>
        @endif

      </tbody>
      
    </table>