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
        return view('admin.admin');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function sports(Request $request)
    {
        //$jsonurl = 'https://api.sportradar.us/soccer-xt3/eu/en/schedules/'.$date.'/schedule.json?api_key='.env('SPORTRADAR_KEY_EU');
        $jsonurl = 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/sports.json?api_key='.env('SPORTRADAR_KEY_ODD_ROW');


        $jsondata = file_get_contents($jsonurl);
        $json = json_decode(utf8_decode($jsondata), true);
        $sports = collect($json['sports']);

        $dbsportsid =Sport::All()->pluck('id');
        foreach($dbsportsid as $key => $value)
            $dbsportsid[$key] = 'sr:sport:'.$value;

        //return $dbsportsid;
        $sportsfiltered = $sports->whereNotIn('id', $dbsportsid);

        return view('admin.sportslist', ['dbsports' => Sport::All(), 'sports' => $sportsfiltered]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function sportsupdate(Request $request)
    {
        //return dd($request->sportschk);

        if($request)
        {
            foreach($request->sportschk as $key=>$value)
            {
                $sport = new Sport;
                $sport->saveSport( ['id' => $key, 'name' => $value] );
            }
        }

        return redirect()->route('admin.sports');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories(Request $request)
    {
        $sportid = 1;
        if($request->sportdd)
        {
            $sportid = $request->sportdd;
        }
        $jsonurl = 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/sports/sr:sport:'.$sportid.'/categories.json?api_key='.env('SPORTRADAR_KEY_ODD_ROW');            

        $jsondata = file_get_contents($jsonurl);
        $json = json_decode(utf8_decode($jsondata), true);
        $categories = collect((isset($json['categories']) ? $json['categories'] : null));

        $dbcategoriesid = Category::All()->pluck('id');
        foreach($dbcategoriesid as $key => $value)
            $dbcategoriesid[$key] = 'sr:category:'.$value;

        //return $dbsportsid;
        $categoriesfiltered = $categories->whereNotIn('id', $dbcategoriesid);



        $sports = Sport::All();
        $sportname = $sports->where('id', $sportid)->pluck('name')->first();
        
        return view('admin.categorieslist', ['sports' => $sports, 'sportid' => $sportid, 'sportname' => $sportname, 'cats' => $categoriesfiltered, 'dbcats' => Category::All()]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoriesupdate(Request $request)
    {
        if($request)
        {
            $jsonurl = 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/categories.json?api_key='.env('SPORTRADAR_KEY_ODD_ROW');            

            $jsondata = file_get_contents($jsonurl);
            $json = json_decode(utf8_decode($jsondata), true);
            $categories = collect((isset($json['categories']) ? $json['categories'] : null));

            $catschk = array_keys($request->catschk);
            foreach($catschk as $key => $value)
            $catschk[$key] = 'sr:category:'.$value;

            $categoriesfiltered = $categories->whereIn('id', $catschk);
            //return dd($categoriesfiltered);

            foreach($categoriesfiltered as $category)
            {
                $c = new Category;
                $c->saveCategory($category);
            }
        }

        return redirect()->route('admin.categories');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function tournaments(Request $request)
    {
        $sports = Sport::All()->sortBy('name');
        $sportid = $sports->first()->id;
        if($request->sportdd)
        {
            $sportid = $request->sportdd;
        }
        $sportname = Sport::find($sportid)->name;

        $categories = Category::All()->where('sport_id', $sportid);
        $categoryid = $categories->first()->id;
        if($request->categorydd)
        {
            $categoryid = $request->categorydd;
        }
        $categoryname = Category::find($categoryid)->name;

        $jsonurl = 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/sports/sr:sport:'.$sportid.'/tournaments.json?api_key='.env('SPORTRADAR_KEY_ODD_ROW');            

        $jsondata = file_get_contents($jsonurl);
        $json = json_decode(utf8_decode($jsondata), true);
        $tournaments = collect((isset($json['tournaments']) ? $json['tournaments'] : null));
        
        $tournamentsfiltered = $tournaments->where('category.id', 'sr:category:'.$categoryid);

        return view('admin.tournamentslist', ['sportid' => $sportid, 'sportname' => $sportname, 'sports' => $sports, 'categoryid' => $categoryid, 'categoryname' => $categoryname, 'categories' => $categories, 'sports' => $sports, 'tournaments' => $tournamentsfiltered, 'dbtournaments' => Tournament::All()]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function tournamentsupdate(Request $request)
    {
        if($request)
        {
            $jsonurl = 'https://api.sportradar.us/oddscomparison-rowt1/pt/eu/tournaments.json?api_key='.env('SPORTRADAR_KEY_ODD_ROW');            

            $jsondata = file_get_contents($jsonurl);
            $json = json_decode(utf8_decode($jsondata), true);
            $tournaments = collect((isset($json['tournaments']) ? $json['tournaments'] : null));

            $tournamentschk = array_keys($request->tournamentschk);
            foreach($tournamentschk as $key => $value)
            $tournamentschk[$key] = 'sr:tournament:'.$value;

            $tournamentsfiltered = $tournaments->whereIn('id', $tournamentschk);
            //return dd($categoriesfiltered);

            foreach($tournamentsfiltered as $tournament)
            {
                $t = new Tournament;
                $t->saveTournament($tournament);
            }

        return redirect()->route('admin.tournaments');
    }



    /**
     * Show the form to update matches
     *
     * @return \Illuminate\Http\Response
     */
    public function matchesupdate(Request $request)
    {
        $date = now()->format('Y-m-d');

        if($request->input('scheduledate'))
            $date = $request->input('scheduledate');


        $jsonurl = 'https://api.sportradar.us/soccer-xt3/eu/en/schedules/'.$date.'/schedule.json?api_key='.env('SPORTRADAR_KEY_EU');

        $jsondata = file_get_contents($jsonurl);
        $json = json_decode(utf8_decode($jsondata), true);
        $matches = $json['sport_events'];

        $tdate = \DateTime::createFromFormat('Y-m-d', $date)->format('d M (D)');

        return view('admin.matchesupdate', ['date' => $tdate, 'matches' => $matches, 'scheduledate' => $date]);
    }

    /**
     * Display a listing of sports.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $date = now()->format('Y-m-d');
        $jsonurl = 'https://api.sportradar.us/soccer-xt3/eu/en/schedules/'.$date.'/schedule.json?api_key='.env('SPORTRADAR_KEY');

        return redirect($jsonurl);

        $jsondata = file_get_contents($jsonurl);
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