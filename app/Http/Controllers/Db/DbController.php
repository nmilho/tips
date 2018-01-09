<?php

namespace App\Http\Controllers\db;

use Illuminate\Http\Request;
use App\Sport;
use App\Season;
use App\Competitor;
use App\Category;
use App\Tournament;
use App\Match;
use App\Books;
use App\Http\Controllers\Controller;

class DbController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.db.index', [
                    'jsonbooks' => 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/books.json?api_key=',
                    'jsonmarkets' => 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/markets.json?api_key=',
                    'jsonsports' => 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/sports.json?api_key=',
                    ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function books()
    {

        return view('admin.db.books');
    }
}