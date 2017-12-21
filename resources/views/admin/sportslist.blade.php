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
							<label class="control-label" style="display: block; text-align: left;">Choose sports to update</label>
							<?php $old = ''; ?>
							@foreach($sports as $sport)
								<?php $id = explode(':', $sport['id'])[2]; ?>
								<div class="col-md-2">
									<div class="checkbox">
								  		<label>
											<input type="checkbox" name="sportschk[{{ $id }}]" value="{{$sport['name']}}">
											{{$sport['name']}} <i class="fa fa-new"></i>
									  	</label>
									</div>
								</div>
								<?php  $old .= ',' . $id; ?>
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