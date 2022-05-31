<div class="row pb-2">
  <div class="from-group col-md-12">
  
  <a href="{{route('helpdesk.index')}}" type="button" class="btn btn-primary pull-right">View All Helpdesk</a>
</div>
</div>
<table class="table table-bordered" id="example">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Date</th>
          <th scope="col">User Name</th>
          <th scope="col">Ticket Number</th>
          <th scope="col">Mobile Number</th>
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
          <td>{{$desk->user_name['name']}}</td>
          <td>{{$desk->id}}</td>
          <td>{{$desk->user_name['mobile_no']}}</td>
          <td> 
            


 <label class="switch">
                   <input type="checkbox"  data-id="{{$desk->id}}" class="toggle-class" data-on="open" data-off="close" {{ ($desk->status =="open") ? "checked" : ""  }} >
                  <span class="slider"></span>
                </label>
              
</td>
<td>
            <a class="badge badge-primary shadow-primary view_response" data-id = "{{$desk->id}}" href="{{route('helpdesk.view',$desk->id)}}"><i class="fa fa-eye" ></i> </a>

            <a class="badge badge-danger shadow-white this_destroy"  data-url="{{route('helpdesk.delete',$desk->id)}}" ><i class="fa fa-trash-o"></i> </a>
          </td>
        </tr>
        @php
          $no++
        @endphp
        @endforeach
      </tbody>
    
    </table>