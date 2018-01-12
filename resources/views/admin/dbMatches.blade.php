@extends('layouts.app')

@section('content')
@if(Auth::check())
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="filters">
                    
                    <form class="form-horizontal" method="POST" action="{{ route('admin.db.dbmatches') }}">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <label class="col-md-2 control-label">Sport</label>
                                <div class="col-md-8">
                                    <select onchange="submit();" class="selectpicker form-control" title="sport" id="sport_id" name="sport_id">
                                        <option value="0">--- Select ---</option>
                                        @foreach($sports as $sport)
                                        <option {{ (isset($sport_id) && $sport_id == $sport->id) ? "selected" : "" }} value="{{ $sport->id }}">{{ $sport->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <label class="col-md-2 control-label">Category</label>
                                <div class="col-md-8">
                                    <select onchange="submit();" class="selectpicker form-control" title="category" id="category_id" name="category_id">
                                        <option value="0">--- Select ---</option>
                                        @if(isset($categories))
                                            @foreach($categories as $category)
                                            <option {{ (isset($category_id) && $category_id == $category->id) ? "selected" : "" }} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <label class="col-md-2 control-label">Tournament</label>
                                <div class="col-md-8">
                                    <select onchange="submit();" class="selectpicker form-control" title="tournament" id="tournament_id" name="tournament_id">
                                        <option value="0">--- Select ---</option>
                                        @if(isset($tournaments))
                                            @foreach($tournaments as $tournament)
                                            <option {{ (isset($tournament_id) && $tournament_id == $tournament->id) ? "selected" : "" }} value="{{ $tournament->id }}">{{ $tournament->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                    </form>

                    @if(isset($sportname) && isset($categoryname) && isset($tournamentname))
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $tournamentname }} matches saved on DB</div>
                            
                        <div class="panel-body">
                            <ul>
                                @foreach($dbmatches->where('sport_id', $sport_id)->where('category_id', $category_id)->where('tournament_id', $tournament_id) as $dbmatches)
                                <li class="col-md-2">{{ $dbmatches->competitor_home->name.' - '.$dbmatches->competitor_away->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    @if(isset($matches))

                    <form class="form-horizontal" method="POST" action="{{ route('admin.db.dbmatchesupdate') }}">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                        <input type="hidden" name="tournament_id" id="tournament_id" value="{{ $tournament_id }}">
                       
                        <div class="form-group">  <!-- Checkbox Group !-->
                            <label class="control-label" style="display: block; text-align: left;">Choose matches to update</label>
                            @foreach($matches as $match)
                                <?php $id = explode(':', $match['id'])[2]; ?>
                                <div class="col-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="matcheschk[{{ $id }}]" value="{{ $id }}" >
                                            <span style="clear: both; display: inline-block; overflow: hidden; white-space: nowrap;">{{ $match['competitors'][0]['name']. ' - ' .$match['competitors'][1]['name'] }} <i class="fa fa-new"></i></span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>  

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                       
                    </form>
                    @else

                    <p>No matches for this tournament.</p>

                    @endif

                </div>
                

            </div>
        </div>
    </div>
@endif
@endsection