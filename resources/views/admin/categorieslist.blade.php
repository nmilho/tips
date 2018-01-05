@extends('layouts.app')

@section('content')
@if(Auth::check())
    <div class="container">
        <div class="row">
            <div class="col-md-12">
        		<div class="filters">
        			
        			<form class="form-horizontal" method="POST" action="{{ route('admin.categories') }}">

	                   	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                   
	                   	<div class="form-group">
	                   		<div class="col-md-8 col-md-offset-2">
		                       	<label class="col-md-2 control-label">Sport</label>
		                       	<div class="col-md-8">
		                           	<select onchange="submit();" class="selectpicker form-control" title="sport" id="sportdd" name="sportdd">
		                           		@foreach($sports as $sport)
		                           		<option {{ $sportid == $sport->id ? "selected" : "" }} value="{{ $sport->id }}">{{ $sport->name }}</option>
		                           		@endforeach
		                           	</select>
		                       	</div>
		                    </div>
	                   	</div>

	               	</form>

	               	<div class="panel panel-default">
	                    <div class="panel-heading">Sports saved on DB</div>
							
						<div class="panel-body">
							<ul>
								@foreach($dbcats->where('sport_id', $sportid) as $dbcat)
								<li class="col-md-2">{{ $dbcat->name }}</li>
								@endforeach
							</ul>
						</div>
					</div>

	               	@if(isset($cats))

        			<form class="form-horizontal" method="POST" action="{{ route('admin.categoriesupdate') }}">

	                   	<input type="hidden" name="_token" value="{{ csrf_token() }}">  
	                   
	                   	<div class="form-group">  <!-- Checkbox Group !-->
							<label class="control-label" style="display: block; text-align: left;">Choose categories to update</label>
							<?php $old = ''; ?>
							@foreach($cats as $cat)
								<?php $id = explode(':', $cat['id'])[2]; ?>
								<div class="col-md-2">
									<div class="checkbox">
								  		<label>
											<input type="checkbox" name="catschk[{{ $id }}]" value="{{$cat['name']}}" >
											{{$cat['name']}} <i class="fa fa-new"></i>
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
	               	@else

	               	<p>No categories for this sport</p>

	               	@endif

        		</div>
            	

            </div>
        </div>
    </div>
@endif
@endsection