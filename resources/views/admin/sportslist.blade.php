@extends('layouts.app')

@section('content')
@if(Auth::check())
    <div class="container">
        <div class="row">
            <div class="col-md-12">
        		<div class="filters">
        			<form class="form-horizontal" method="POST" action="{{ route('admin.sports') }}">

	                   	<input type="hidden" name="_token" value="{{ csrf_token() }}">  
	                   
	                   	<div class="form-group">
	                   		<div class="col-md-8 col-md-offset-2">
		                       	<label class="col-md-2 control-label">Data</label>
		                       	<div class="col-md-8">
		                           	<input type="date" class="form-control" name="date" format="Y-m-d" value="{{ $date }}" onchange="this.form.submit();">
		                       	</div>
		                    </div>
	                   	</div>
	                   
	               	</form>

        			<form class="form-horizontal" method="POST" action="{{ route('admin.sportsupdate') }}">

	                   	<input type="hidden" name="_token" value="{{ csrf_token() }}">  
	                   
	                   	<div class="form-group">  <!-- Checkbox Group !-->
							<label class="control-label">Choose sports to update</label>
							<?php $old = ''; ?>
							@foreach($sports as $sport)
							<?php $id = explode(':', $sport['tournament']['sport']['id'])[2] ?>
							@if(array_has(str_split($old), $id))
							<div class="checkbox">
						  		<label>
									<input type="checkbox" name="{{$sport['tournament']['sport']['id']}}" value="{{ $id }}">
									{{$sport['tournament']['sport']['name']}}
							  	</label>
							</div>
							<?php  $old .= ',' . $id; ?>
							@endif
							@endforeach
						</div>	
	                   
	               	</form>

        		</div>
            	

            </div>
        </div>
    </div>
@endif
@endsection