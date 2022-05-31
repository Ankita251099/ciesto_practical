@extends('layouts.master') 
@section('title','LeaderBoard')
@section('content')

<div class="card">
  <div class="card-header">

    <h4 class="card-title">Leaderboard</h4>
  </div>
  <div class="card-body">
     <div class="row">
      <div class="form-group col-md-2">
      <label>Type:</label>
        <select id='type' class="form-control text-center type" style="width: 200px;margin-bottom: 8px;">
                <option value="">--Select Type--</option>
                <option value="alltime">All Time</option>
                <option value="thisweek">This Week</option>
                <option value="thismonth">This Month</option>
              </select>
        </div>
      </div>
        <div class="table_dynamic">
            @include('leaderboard.dynamic_table')
        </div>
   
  </div>
  
</div>

@endsection
@section('script')
<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="js/plugins-init/datatables.init.js"></script>
<script type="text/javascript">
  
  $('.type').on('change',function(){

    // alert('sdff');
        var data = $(this).val(); 
        // alert(data);

            $.ajax({
            type: "GET",
            url: "{{ route('getLeaderboard_data') }}",
            data: {
              "data":data,
            },        
            success: function (data)
            {              
                  $('.table_dynamic').html(data.data);
                   $('#example').DataTable();
                }

                });
    });   

</script>

@endsection
