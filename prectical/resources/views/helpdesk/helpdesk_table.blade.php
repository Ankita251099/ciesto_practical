<table class="table table-bordered" id="example">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Date</th>
          <th scope="col">User Name</th>
          <th scope="col">Ticket Number</th>
          <th scope="col">Issue</th>
          <th scope="col">Issue Type</th>
          <th scope="col">Mobile Number</th>
        <!--   <th scope="col">Image</th> -->
          <th scope="col">Status</th>
          <th scope="col">Action</th>
          
        </tr>
      </thead>
      <tbody>
        @php
          $no=1
        @endphp
       
        @foreach($desks as $desk)
        <tr>
          <th scope="row">{{$no}}</th>
          <td>{{date('d-M-Y',strtotime($desk->created_at))}}</td>
          <td>{{$desk->user_name['user_name']}}</td>
          <td>{{$desk->id}}</td>
          <td>{{$desk->issue}}</td>
          <td>{{$desk->issue_type}}</td>
          <td>{{$desk->user_name['mobile_no']}}</td>
          <!-- <td>
           @if(!is_null($desk->attechment))
            
            <img width="100px" src="{{asset('upload/'.$desk->attechment)}}">
            @else
            @endif
          </td> -->
          <td>
    <div class="onoffswitch">
    <input type="checkbox" data-id="{{$desk->id}}" name="onoffswitch toggle_button" class="onoffswitch-checkbox toggle-class" id="myonoffswitch_{{$desk->id}}"data-on="open" data-off="close"  {{ ($desk->status =="open") ? "checked" : ""  }}>
    <label class="onoffswitch-label" for="myonoffswitch_{{$desk->id}}">
        <span class="onoffswitch-inner"></span>
        <span class="onoffswitch-switch"></span>
    </label>
</div>
          </td>
          <td>
            <a class="badge badge-primary shadow-primary view_response" data-id = "{{$desk->id}}" href="{{route('helpdesk.view',$desk->id)}}"><i class="fa fa-eye" ></i> </a>

            <a class="badge badge-danger shadow-danger this_destroy" data-url="{{route('helpdesk.delete',$desk->id)}}" ><i class="fa fa-trash-alt"style="color: white;"></i> </a>
          </td>
        </tr>
        @php
          $no++
        @endphp
        @endforeach
      </tbody>
    
    </table>