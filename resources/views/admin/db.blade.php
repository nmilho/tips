@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Database</div>

                <div class="panel-body">

                    <a href="{{ route('admin.db.sports') }}">
                        <div class="col-md-4">
                            <div class="panel-heading">Sports</div>

                            <div class="panel-body">
                                <img src="/img/admin/sports.jpg">
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection