@extends('layouts.app')

@section('content')
@if(Auth::check())
    <div class="container">
        <div class="row">
            <div class="col-md-12">
        		<div class="filters">
        			
        			<div class="panel panel-default">
        				<div class="panel-heading">Tournaments</div>
        			</div>

        		</div>
            	

            </div>
        </div>
    </div>
@endif
@endsection