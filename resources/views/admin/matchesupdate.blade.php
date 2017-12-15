@extends('layouts.app')

@section('content')
@if(Auth::check())
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

            	<div class="fixture">
	                <div class="panel panel-default">
	                    <div class="panel-heading">Matches for day  {{ $date }}</div>
							
							<div class="panel-body tournaments">
		                    @foreach($matches as $match)
		                    	<div class="panel panel-default ">

				                    <div class="panel-heading">
				                    	{{ $match['tournament']['category']['name'] . ' - ' . $match['tournament']['name']  }}
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