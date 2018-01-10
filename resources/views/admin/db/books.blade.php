@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Books Management
            <p class="small">Manage all books active on radar and db</p>
        </h2>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">
          Bookers on Radar
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="table">
          <table id="radarBooks" class="table table-striped table-hover" ><!--table-striped table-bordered table-hover-->
              <thead>
                <tr>
                  <th class="text-center">Id</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($books as $book)
                <tr>
                  <td class="text-center">{{ $book['id'] }}</td>
                  <td class="text-center">{{ $book['name'] }}</td>
                  <td class="text-center">
                    <button class="save-modal btn btn-sm btn-success" 
                      data-info="{{ $book['id'] }},{{ $book['name'] }}">
                      <span class="fa fa-save"></span> 
                      Save
                    </button>
                  </td>
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
          Bookers on Database
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="table">
          <table id="dbBooks" class="table table-striped table-hover">
              <thead>
                <tr>
                  <th class="text-center">Id</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($booksDb as $book)
                <tr>
                  <td class="text-center">{{ $book['id'] }}</td>
                  <td class="text-center">{{ $book['name'] }}</td>
                  <td class="text-center"><button class="delete-modal btn btn-sm btn-danger"
                        data-info="{{ $book['id'] }},{{ $book['name'] }}">
                        <span class="fa fa-trash"></span> 
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
          </form>
          <div class="deleteContent">
            Are you Sure you want to delete <span class="dname"></span> ? <span class="hidden did"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn actionBtn" data-dismiss="modal">
              <span id="footer_action_button" class="glyphicon"> </span>
            </button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">
              <span class="glyphicon glyphicon-remove"></span> Close
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
    $('#footer_action_button').show();
    $('#footer_action_button').text("Save");
    $('#footer_action_button').addClass('fa fa-check');
    $('#footer_action_button').removeClass('fa fa-trash');
    $('.actionBtn').show();
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('delete');
    $('.actionBtn').addClass('save');
    $('.modal-title').text('Save');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    var stuff = $(this).data('info').split(',');
    fillBookModalData(stuff);
    $('#myModal').modal('show');
  });

  $(document).on('click', '.delete-modal', function() {
    $('#footer_action_button').show();
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').show();
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
            type: 'post',
            url: '{{ route('admin.db.deletebooks') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
              alert($('.did').text());
                $('.item' + $('.did').text()).remove();
            }
        });
    });

  $('.modal-footer').on('click', '.save', function() {
        var name = $('#fname').val();
        var id = $("#fid").val()

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            url: '{{ route('admin.db.updatebooks') }}',
            data: {id: id, name: name},
            success: function( data, status, error ) {
                /*console.log('Data => ' + JSON.stringify(data));
                console.log('Status => ' + status);
                console.log('Error => ' + JSON.stringify(error, null, 2));*/
                if (data.errors){
                  $('#myModal').modal('show');
                  if(data.errors.name) {
                      $('.fname_error').removeClass('hidden');
                      $('.fname_error').text(data.errors.name);
                  }
                }
                else {
                   
                   $('.error').addClass('hidden');
                    $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" +
                      data.id + "</td><td>" + data.name +
                      "</td><td><button class='edit-modal btn btn-info' data-info='" + data.id+","+data.name+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='" + data.id+","+data.name+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                      location.reload();
                }
            },
            error: function(request, status, error) {
                console.log('Request->message => ' + request.responseJSON['message']);
                console.log('Status => ' + status);
                console.log('Error => ' + error);
            }
        });

  });

</script>

@endsection