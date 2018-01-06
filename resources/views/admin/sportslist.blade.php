@extends('layouts.app')

@section('content')
@if(Auth::check())
    <div class="container">
        <div class="row">
            <div class="col-md-12">
        		<div class="filters">
        			
        			<div class="panel panel-default">
	                    <div class="panel-heading">Sports saved on DB</div>
							
						<div class="panel-body">
							<ul>
								@foreach($dbsports as $dbsport)
								<li class="col-md-2">{{ $dbsport->name }}</li>
								@endforeach
							</ul>
						</div>
					</div>


        			<form class="form-horizontal" method="POST" action="{{ route('admin.sportsupdate') }}">

	                   	<input type="hidden" name="_token" value="{{ csrf_token() }}">  
	                   
	                   	<div class="form-group">  <!-- Checkbox Group !-->
							<label class="control-label" style="display: block; text-align: left;">Choose sports to update</label>
							@foreach($sports as $sport)
								<?php $sport['id'] = ( (!strtok($sport['id'], ':').strtok(':')) ? strtok(':') : $sport['id'] ) ; ?>
								<div class="col-md-2">
									<div class="checkbox">
								  		<label>
											<input type="checkbox" name="sportschk[{{ $sport['id'] }}]" value="{{$sport['name']}}">
											{{$sport['name']}} <i class="fa fa-new"></i>
									  	</label>
									</div>
								</div>
							@endforeach
						</div>	

						<div class="col-md-2">
                           	<button type="submit" class="btn btn-primary">Submit</button>
                       	</div>
	                   
	               	</form>

        		</div>
            	

            </div>
        </div>
    </div>
@endif
@endsection