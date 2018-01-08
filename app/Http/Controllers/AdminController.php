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
     * Admin database
     *
     * @return \Illuminate\Http\Response
     */
    public function db()
    {
        return view('admin.db');
    }

    /**
     * Admin table admin sports
     *
     * @return \Illuminate\Http\Response
     */
    public function dbSports()
    {
        $jsonurl = 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/sports.json?api_key='.env('SPORTRADAR_KEY_ODD_ROW');

        $jsondata = file_get_contents($jsonurl);
        $json = json_decode(utf8_decode($jsondata), true);

        $sports = collect($json['sports']);
        
        $dbsportsid =Sport::All()->pluck('id');

        foreach($dbsportsid as $key => $value)
            $dbsportsid[$key] = 'sr:sport:'.$value;
        
        $sportsfiltered = $sports->whereNotIn('id', $dbsportsid);

        return view('admin.dbSports', ['dbsports' => Sport::All(), 'sports' => $sportsfiltered]);
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function dbSportsUpdate(Request $request)
    {
        if($request)
        {
            $this->validate($request, [
                'sportschk'   => 'required'
            ]);

            foreach($request->sportschk as $key=>$value)
            {
                $sport = new Sport;
                $sport->saveSport( ['id' => $key, 'name' => $value] );
            }
        }
        return redirect()->route('admin.db.sports');
    }



    /**
     * Display a specified ticket.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dbCategories(Request $request)
    {
        
        $sport_id = 0;
        if($request->sport_id)
        {
            $sport_id = $request->sport_id;
        }

        if($sport_id !== 0)
        {

            $jsonurl = 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/sports/sr:sport:'.$sport_id.'/categories.json?api_key='.env('SPORTRADAR_KEY_ODD_ROW');            
            $jsondata = file_get_contents($jsonurl);
            $json = json_decode(utf8_decode($jsondata), true);

            $categories = collect((isset($json['categories']) ? $json['categories'] : null));

            $dbcategoriesid = Category::All()->pluck('id');

            foreach($dbcategoriesid as $key => $value)
                $dbcategoriesid[$key] = 'sr:category:'.$value;

            $categoriesfiltered = $categories->whereNotIn('id', $dbcategoriesid);

            $sports = Sport::All()->sortBy('name');
            
            $sportname = $sports->where('id', $sport_id)->pluck('name')->first();
            
            return view('admin.dbCategories', ['sports' => $sports, 'sport_id' => $sport_id, 'sportname' => $sportname, 'cats' => $categoriesfiltered, 'dbcats' => Category::All()]);
        }
        else 
        {

            $sports = Sport::All()->sortBy('name');

            return view('admin.dbCategories', ['sports' => $sports, 'sport_id' => $sport_id]);
        }
    }




    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dbCategoriesUpdate(Request $request)
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
            
            

            foreach($categoriesfiltered as $category)
            {
                $c = new Category;
                $c->saveCategory($category);
                $sport_id = $c['sport_id'];
            }
        }
        return redirect()->action( 'AdminController@dbCategories', ['sport_id' => $sport_id] );
    }




    /**
     * Display a specified ticket.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dbTournaments(Request $request)
    {
        $sports = Sport::All()->sortBy('name');
        $sport_id = 0;
        if($request->sport_id)
        {
            $sport_id = $request->sport_id;
        }

        if($sport_id !== 0)
        {
            $sportname = Sport::find($sport_id)->name;

            $categories = Category::All()->where('sport_id', $sport_id)->sortBy('name');

            $category_id = 0;
            if($request->category_id)
            {
                $category_id = $request->category_id;
            }

            if($category_id !== 0)
            {
                $categoryname = Category::find($category_id)->name;

                $jsonurl = 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/sports/sr:sport:'.$sport_id.'/tournaments.json?api_key='.env('SPORTRADAR_KEY_ODD_ROW');            
                $jsondata = file_get_contents($jsonurl);
                $json = json_decode(utf8_decode($jsondata), true);

                $tournaments = collect((isset($json['tournaments']) ? $json['tournaments'] : null));

                $dbtournamentsid = Tournament::All()->pluck('id');

                foreach($dbtournamentsid as $key => $value)
                    $dbtournamentsid[$key] = 'sr:tournament:'.$value;

                $tournamentsfiltered = $tournaments->whereNotIn('id', $dbtournamentsid);
                
                $tournamentsfiltered = $tournamentsfiltered->where('category.id', 'sr:category:'.$category_id);
                //return dd($tournamentsfiltered);

                return view('admin.dbTournaments', ['sport_id' => $sport_id, 'sportname' => $sportname, 'sports' => $sports, 'category_id' => $category_id, 'categoryname' => $categoryname, 'categories' => $categories, 'sports' => $sports, 'tournaments' => $tournamentsfiltered, 'dbtournaments' => Tournament::All()->sortBy('name')]);
            }
            else
            {
                $sports = Sport::All()->sortBy('name');
                $categories = Category::All()->where('sport_id', $sport_id);

                return view('admin.dbTournaments', ['sports' => $sports, 'sport_id' => $sport_id, 'categories' => $categories, 'category_id' => $category_id]);
            }
        }
        else
        {
            $sports = Sport::All()->sortBy('name');

            return view('admin.dbTournaments', ['sports' => $sports, 'sport_id' => $sport_id]);
        }
    }




    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dbTournamentsUpdate(Request $request)
    {
        if($request)
        {
            $jsonurl = 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/tournaments.json?api_key='.env('SPORTRADAR_KEY_ODD_ROW');            
            $jsondata = file_get_contents($jsonurl);
            $json = json_decode(utf8_decode($jsondata), true);

            $tournaments = collect((isset($json['tournaments']) ? $json['tournaments'] : null));

            $tournamentschk = array_keys($request->tournamentschk);
            foreach($tournamentschk as $key => $value)
                $tournamentschk[$key] = 'sr:tournament:'.$value;

            $tournamentsfiltered = $tournaments->whereIn('id', $tournamentschk);
            
            
            foreach($tournamentsfiltered as $tournament)
            {
                $s = new Season;
                $s->saveSeason($tournament['current_season']);

                $t = new Tournament;
                $res = $t->saveTournament($tournament);

                $sport_id = $t['sport_id'];                
                $category_id = $t['category_id'];
            }
        }
        return redirect()->action( 'AdminController@dbTournaments', ['sport_id' => $sport_id, 'category_id' => $category_id] );
    }


}