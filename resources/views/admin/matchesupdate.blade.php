@extends('layouts.app')

@section('content')
@if(Auth::check())
    <div class="container">
        <div class="row">
            <div class="col-md-12">
        		<div class="filters">
        			<form class="form-horizontal" method="POST" action="{{ route('admin.matchesupdate') }}">

	                   	<input type="hidden" name="_token" value="{{ csrf_token() }}">  
	                   
	                   	<div class="form-group">
	                   		<div class="col-md-8 col-md-offset-2">
		                       	<label class="col-md-2 control-label">Data</label>
		                       	<div class="col-md-8">
		                           	<input type="date" class="form-control" name="scheduledate" format="Y-m-d" value="{{ $scheduledate }}">
		                       	</div>
		                       	<div class="col-md-2">
		                           	<button type="submit" class="btn btn-primary">Submit</button>
		                       	</div>
		                    </div>
	                   	</div>
	                   
	               	</form>

        		</div>
            	<div class="fixture">
	                <div class="panel panel-default">
	                    <div class="panel-heading">Matches for day  {{ $date }}</div>
							
							<div class="panel-body tournaments">
		                    @foreach($matches as $match)
		                    	<div class="panel panel-default ">

				                    <div class="panel-heading">
				                    	{{ $match['tournament']['category']['name'] . ' - ' . $match['tournament']['name'] . ' - round: ' . $match['tournament_round']['number'] }}
				                    </div>

									<div class="panel-body matches">

										<div class="panel panel-default">
	                    					
	                    					<div class="panel-heading home">
	                    						{{ substr(explode('T', $match['scheduled'])[1], 0,5) . '  :  ' . $match['competitors'][0]['name'] . ' - ' . $match['competitors'][1]['name']  }}
	                    					</div>

	                    				</div>

									</div>

								</div>	                    
		                    @endforeach
	                    </div>

	                </div>
            	</div><!-- end fixture -->

            </div>
        </div>
    </div>
@endif
@endsection