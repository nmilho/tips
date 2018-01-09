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
          Booker on Radar
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="table">
          <table id="radarBooks" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>All</th>
                  <th>Id</th>
                  <th>Name</th>
                </tr>
              </thead>
              <tbody>
              @foreach($books as $book)
                <tr>
                  <td>1</td>
                  <td>{{ $book['id'] }}</td>
                  <td>{{ $book['name'] }}</td>
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
          Booker on Database
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="table">
          <table id="dbBooks" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>All</th>
                  <th>Id</th>
                  <th>Name</th>
                </tr>
              </thead>
              <tbody>
              @foreach($booksDb as $book)
                <tr>
                  <td>1</td>
                  <td>{{ $book['id'] }}</td>
                  <td>{{ $book['name'] }}</td>
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