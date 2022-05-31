  <div class="row pb-2">
     
      
    </div>
    <table class="table table-bordered" id="example">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Date</th>
          <th scope="col">User Name</th>
          <th scope="col">Full Name</th>
          <th scope="col">Mobile No</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
          
        </tr>
      </thead>
     <tbody>
        @php
          $no=1
        @endphp
       @if(count($kycs)>0)
        @foreach($kycs as $kyc)
        <tr>
          <th scope="row">{{$no}}</th>
          <td>{{date('d-M-Y',strtotime($kyc->created_at))}}</td>
          <td>{{$kyc->user_name}}</td>
          <td>{{$kyc->name}}</td>
          <td>{{$kyc->mobile_no}}</td>
          <td>
            @if($kyc->kyc_status == "verified")
            <span style=" background-color: #0CC27E; color: white ;padding: 2px;border-radius: 5px">Verified</span>
            @elseif($kyc->kyc_status == "rejected")
            <span style=" background-color: #dc3545; color: white ;padding: 2px;border-radius: 5px">Rejected</span>
            @elseif($kyc->kyc_status == "padding")
            <span style=" background-color: #fd7e14; color: white ;padding: 2px;border-radius: 5px">Padding</span>
            @elseif($kyc->kyc_status == "submited")
            <span style=" background-color: #fd7e14; color: white ;padding: 2px;border-radius: 5px">Padding</span>
            @endif
          </td>
          <td>
            @if($kyc->kyc_status=="rejected")
            <a class="badge badge-success shadow-success this_verified" data-url="{{route('kyc.verified')}}" data-id="{{$kyc->id}}"><i class="fa fa-check" ></i> </a>
            <a class="badge badge-danger shadow-danger this_rejected" data-id="{{$kyc->id}}" data-url="{{route('kyc.rejected')}}" ><i class="fa fa-times"></i> </a>

         <a href="{{route('kyc.create',$kyc->id)}}"class="badge badge-primary shadow-primary view_response" ><i class="fa fa-eye" ></i> </a>
          @elseif($kyc->kyc_status=="padding")
          <a class="badge badge-success shadow-success this_verified" data-url="{{route('kyc.verified')}}" data-id="{{$kyc->id}}"><i class="fa fa-check" ></i> </a>
            <a class="badge badge-danger shadow-danger this_rejected" data-id="{{$kyc->id}}" data-url="{{route('kyc.rejected')}}" ><i class="fa fa-times"></i> </a>

          <a href="{{route('kyc.create',$kyc->id)}}" class="badge badge-primary shadow-primary view_response"><i class="fa fa-eye" ></i> </a>

          @elseif($kyc->kyc_status=="submited")
          <a class="badge badge-success shadow-success this_verified" data-url="{{route('kyc.verified')}}" data-id="{{$kyc->id}}"><i class="fa fa-check" ></i> </a>
            <a class="badge badge-danger shadow-danger this_rejected" data-id="{{$kyc->id}}" data-url="{{route('kyc.rejected')}}" ><i class="fa fa-times"></i> </a>

          <a href="{{route('kyc.create',$kyc->id)}}" class="badge badge-primary shadow-primary view_response"><i class="fa fa-eye" ></i> </a>
         
          @elseif($kyc->kyc_status=="verified")
          <a class="badge badge-success shadow-success this_verified" data-url="{{route('kyc.verified')}}" data-id="{{$kyc->id}}"><i class="fa fa-check" ></i> </a>
            <a href="{{route('kyc.create',$kyc->id)}}" class="badge badge-primary shadow-primary view_response"><i class="fa fa-eye" ></i> </a>
            @endif
          </td>
        </tr>
        @php
          $no++
        @endphp
        @endforeach
        @else
        <td colspan="4" class="text-center">No Record Found</td>
        @endif

      </tbody>
      
    </table>
  </div>