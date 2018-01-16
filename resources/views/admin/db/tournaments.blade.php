@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Tournaments Management
            <p class="small">Manage all tournaments active on radar and db</p>
        </h2>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tournaments on Radar
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table">
                    <table id="radarTournaments" class="table table-striped table-hover" >
                        <thead>
                          <tr>
                              <th class="text-center">Id</th>
                              <th class="text-center">Name</th>
                              <th class="text-center">Sport</th>
                              <th class="text-center">Category</th>
                              <th class="text-center">Season</th>
                              <th class="text-center">Actions</th>
                          </tr>
                      </thead>

                      <tbody>
                      @foreach($tournaments as $tournament)
                          <tr>
                              <td class="text-center">{{ $tournament['id'] }}</td>
                              <td class="text-center">{{ $tournament['name'] }}</td>
                              <td class="text-center">{{ $tournament['sport']['name'] }}</td>
                              <td class="text-center">{{ $tournament['category']['name'] }}</td>
                              <td class="text-center">{{ $tournament['current_season']['year'] }}</td>
                              <td class="text-center">
                                  <button class="save-modal btn btn-sm btn-success" 
                                      data-info="{{ $tournament['id'] }},{{ $tournament['name'] }},{{ $tournament['sport']['id'] }},{{ $tournament['category']['id'] }},{{ $tournament['current_season']['id'] }},{{ $tournament['current_season']['name'] }},{{ $tournament['current_season']['start_date'] }},{{ $tournament['current_season']['end_date'] }},{{ $tournament['current_season']['year'] }}">
                                      <i class="fa fa-floppy-o" aria-hidden="true"></i> 
                                      Save
                                  </button>
                              </td>
                          </tr>
              @endforeach
              </tbody>
            </table>
          </div>  
      </div>
      <!-- /.panel-body -->
    </div>
  </div>
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">
          Tournaments on Database
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="table">
          <table id="dbTournaments" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th class="text-center">Id</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Sport</th>
                  <th class="text-center">Category</th>
                  <th class="text-center">Season</th>
                  <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($tournamentsDb as $tournament)
                <tr>
                  <td class="text-center">{{ $tournament['id'] }}</td>
                  <td class="text-center">{{ $tournament['name'] }}</td>
                  <td class="text-center">{{ $tournament['sport']['name'] }}</td>
                  <td class="text-center">{{ $tournament['category']['name'] }}</td>
                  <td class="text-center">{{ $tournament['season']['year'] }}</td>
                  <td class="text-center"><button class="delete-modal btn btn-sm btn-danger"
                        data-info="{{ $tournament['id'] }},{{ $tournament['name'] }},{{ $tournament['sport']['id'] }},{{ $tournament['category']['id'] }},{{ $tournament['season']['id'] }},{{ $tournament['season']['name'] }},{{ $tournament['season']['start_date'] }},{{ $tournament['season']['end_date'] }},{{ $tournament['season']['year'] }}"> 
                        <i class="fa fa-trash" aria-hidden="true"></i> 
                        Delete
                    </button>
                  </td>
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


@section('modal')
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title"></h4>

        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form">
            <div class="form-group">
              <label class="control-label col-sm-2" for="id">ID</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="fid" disabled="" >
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="fname">Name</label>
              <div class="col-sm-10">
                <input type="name" class="form-control" id="fname" disabled="" >
              </div>
            </div>
            <p class="fname_error error text-center alert alert-danger hidden"></p>
            
            <input type="hidden" class="form-control" id="fsport" disabled="" >            
            <p class="fsport_error error text-center alert alert-danger hidden"></p>
            <input type="hidden" class="form-control" id="fcategory" disabled="" >
            <p class="fcategory_error error text-center alert alert-danger hidden"></p>
            <input type="hidden" class="form-control" id="fseason" disabled="" >
            <input type="hidden" class="form-control" id="fseasonname" disabled="" >
            <input type="hidden" class="form-control" id="fseasonstart" disabled="" >
            <input type="hidden" class="form-control" id="fseasonend" disabled="" >
            <input type="hidden" class="form-control" id="fseasonyear" disabled="" >
            <p class="fseason_error error text-center alert alert-danger hidden"></p>
          </form>
          <div class="deleteContent">
            Are you Sure you want to delete <span class="dname"></span> ? <span class="hidden did"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn actionBtn" data-dismiss="modal">
              
            </button>
            <button id="delbtn" type="button" class="btn btn-warning" data-dismiss="modal">
              <i class="fa fa-remove"></i> Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('actionscripts')

<script>
  $(document).on('click', '.save-modal', function() {
    $('.actionBtn').text('');
    $('.actionBtn').append('<i class="fa fa-floppy-o"></i> Save');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('delete');
    $('.actionBtn').addClass('save');
    $('.modal-title').text('Save');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    var stuff = $(this).data('info').split(',');
    fillTournamentModalData(stuff);
    $('#myModal').modal('show');
  });

  $(document).on('click', '.delete-modal', function() {
    $('.actionBtn').text('');
    $('.actionBtn').append('<i class="fa fa-trash-o"></i> Delete');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').removeClass('save');
    $('.actionBtn').addClass('delete');
    $('.modal-title').text('Delete');
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    var stuff = $(this).data('info').split(',');
    $('.did').text(stuff[0]);
    $('.dname').html(stuff[1]);
    $('#myModal').modal('show');
  });

  

  $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            url: '{{ route('admin.db.deletetournaments') }}',
            data: {
                'id': $('.did').text()
            },
            success: function( data, status, error ) {
                console.log('success');
                console.log('Data => ' + JSON.stringify(data));
                console.log('Status => ' + status);
                console.log('Error => ' + JSON.stringify(error, null, 2));
                location.reload();
            },
            error: function(request, status, error) {
              console.log('error');
                //console.log('Data => ' + JSON.stringify(data));
                console.log('Request->message => ' + request.responseJSON['message']);
                console.log('Status => ' + status);
                //console.log('Error => ' + JSON.stringify(error, null, 2));
                console.log('Error => ' + error);
                //location.reload();
            }
        });
    });

  $('.modal-footer').on('click', '.save', function() {
        var name = $('#fname').val();
        var id = $("#fid").val();
        var sport = $('#fsport').val();
        var category = $("#fcategory").val();
        var season = $("#fseason").val();
        var seasonname = $("#fseasonname").val();
        var seasonstart = $("#fseasonstart").val();
        var seasonend = $("#fseasonend").val();
        var seasonyear = $("#fseasonyear").val();

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            url: '{{ route('admin.db.updatetournaments') }}',
            data: {tournament:{id: id, name: name, sport_id: sport, category_id: category, season_id: season},season: {id: season, name: seasonname, start_date: seasonstart, end_date: seasonend, year: seasonyear}},
            success: function( data, status, error ) {
                console.log('Data => ' + JSON.stringify(data));
                console.log('Status => ' + status);
                console.log('Error => ' + JSON.stringify(error, null, 2));
                if (data.errors){
                  $('#myModal').modal('show');
                  if(data.errors.name) {
                      $('.fname_error').removeClass('hidden');
                      $('.fname_error').text(data.errors.name);
                  }
                }
                else {                   
                    $('.error').addClass('hidden');
                    location.reload();
                }
            },
            error: function(request, status, error) {
                //console.log('Data => ' + JSON.stringify(data));
                console.log('Request->message => ' + request.responseJSON['message']);
                console.log('Status => ' + status);
                //console.log('Error => ' + JSON.stringify(error, null, 2));
                console.log('Error => ' + error);
            }
        });

  });

</script>

@endsection