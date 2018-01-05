@extends('layouts.app')

@section('content')
@if(Auth::check())
    <div class="container">
        <div class="row">
            <div class="col-md-12">
        		<div class="filters">
        			
        			<form class="form-horizontal" method="POST" action="{{ route('admin.tournaments') }}">

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
	                    <div class="panel-heading">{{ $sportname }} Tournaments saved on DB</div>
							
						<div class="panel-body">
							<ul>
								@foreach($dbtournaments->where('sport_id', $sportid) as $dbtournament)
								<li class="col-md-2">{{ $dbtournament->name }}</li>
								@endforeach
							</ul>
						</div>
					</div>

	               	@if(isset($tournaments))

        			<form class="form-horizontal" method="POST" action="{{ route('admin.tournamentsupdate') }}">

	                   	<input type="hidden" name="_token" value="{{ csrf_token() }}">  
	                   
	                   	<div class="form-group">  <!-- Checkbox Group !-->
							<label class="control-label" style="display: block; text-align: left;">Choose tournaments to update</label>
							<?php $old = ''; ?>
							@foreach($tournaments as $tournament)
								<?php $id = explode(':', $tournament['id'])[2]; ?>
								<div class="col-md-2">
									<div class="checkbox">
								  		<label>
											<input type="checkbox" name="tournamentschk[{{ $id }}]" value="{{$tournament['name']}}" >
											{{$tournament['name']}} <i class="fa fa-new"></i>
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

	               	<p>No tournaments for this sport</p>

	               	@endif

        		</div>
            	

            </div>
        </div>
    </div>
@endif
@endsection