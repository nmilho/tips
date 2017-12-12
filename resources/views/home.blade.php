@extends('layouts.app')

@section('content')
    @if(Auth::check())
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div style="align-items: center;display: flex;justify-content: center;height: 85vh;">
                    <div class="content" style="text-align: center; font-weight: 100;">
                        <div class="title m-b-md" style="margin-bottom: 30px;font-size: 84px;">
                            Laravel
                        </div>

                        <div class="links" >
                            <a style="color: #636b6f;padding: 0 25px;font-size: 12px;font-weight: 600;letter-spacing: .1rem;text-decoration: none;text-transform: uppercase;" href="https://laravel.com/docs">Documentation</a>
                            <a style="color: #636b6f;padding: 0 25px;font-size: 12px;font-weight: 600;letter-spacing: .1rem;text-decoration: none;text-transform: uppercase;" href="https://laracasts.com">Laracasts</a>
                            <a style="color: #636b6f;padding: 0 25px;font-size: 12px;font-weight: 600;letter-spacing: .1rem;text-decoration: none;text-transform: uppercase;" href="https://laravel-news.com">News</a>
                            <a style="color: #636b6f;padding: 0 25px;font-size: 12px;font-weight: 600;letter-spacing: .1rem;text-decoration: none;text-transform: uppercase;" href="https://forge.laravel.com">Forge</a>
                            <a style="color: #636b6f;padding: 0 25px;font-size: 12px;font-weight: 600;letter-spacing: .1rem;text-decoration: none;text-transform: uppercase;" href="https://github.com/laravel/laravel">GitHub</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
