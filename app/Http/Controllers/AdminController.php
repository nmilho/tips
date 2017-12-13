<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sport;
use App\Season;
use App\Competitor;
use App\Category;
use App\Tournament;
use App\Match;

class AdminController extends Controller
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
        return view('admin');
    }

    /**
     * Display a listing of sports.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $jsondata = file_get_contents('https://api.sportradar.us/soccer-xt3/eu/en/schedules/2017-12-14/schedule.json?api_key='.env('SPORTRADAR_KEY'));
        $json = json_decode(utf8_decode($jsondata), true);
        $matches = $json['sport_events'];
        
        //return dd($matches);

        foreach($matches as $id => $match) 
        {
            //$data = array('id'=>$match['tournament']['sport']['id'], 'name'=>$match['tournament']['sport']['name']);
            $sport = new Sport();
            $sport->saveSport($match['tournament']['sport']);

            $category = new Category();
            $category->saveCategory($match['tournament']['category']);

            $tournament = new Tournament();
            $tournament->saveTournament($match['tournament']);

            $season = new Season();
            $season->saveSeason($match['season']);

            $competitor = new Competitor();
            $competitor->saveCompetitor($match['competitors'][0]);
            $competitor = new Competitor();
            $competitor->saveCompetitor($match['competitors'][1]);

            $data = array('id'=>$match['id'], 'scheduled'=>$match['scheduled'], 'season'=>$match['season']['id'], 
                        'tournament'=>$match['tournament']['id'], 'competitorh'=>$match['competitors'][0]['id'],
                        'competitora'=>$match['competitors'][1]['id']);


            $_match = Match::updateOrCreate($data);
        }

        //TODO::return view with last store summary


        //return View('tournaments', [ 'tournaments' => $tournaments ]);
        //return View('tournaments');
    }
}