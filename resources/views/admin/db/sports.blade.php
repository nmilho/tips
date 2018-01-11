@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Sports Management
            <p class="small">Manage all sports active on radar and db</p>
        </h2>
    </div>
<!-- /.col-lg-12 -->
</div>

<div class="row">
  <div class="col-lg-7">
    <div class="panel panel-default">
      
      <div class="panel-heading">
        Sports on Radar
      </div>
      <!-- /.panel-heading -->

      <div class="panel-body">
        <div class="table">
          <table id="radarSports" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>  
      </div>
      <!-- /.panel-body -->

    </div>
  </div>

  <div class="col-lg-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        Sports on Database
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="table">
          <table id="dbSports" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
              </tr>
            </thead>
            <tbody>
            @foreach($sportsDb as $sportdb)
              <tr>
                <td>{{ $sportdb['id'] }}</td>
                <td>{{ $sportdb['name'] }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.panel-body -->
    </div>
  </div>
</div>
<!-- /.row -->
@endsection









@section('actionscripts')

<script>

    $('#radarSports').DataTable( {
        "ajax": "{{ 'admin.db.sports.json' }}",
        "columns": [
            { "data": "id" },
            { "data": "name" }
        ]
    } );

    $('#dbSports').DataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
  } );
</script>

@endsection