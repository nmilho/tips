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

            $sports = Sport::All();

            $sportname = $sports->where('id', $sport_id)->pluck('name')->first();
            
            return view('admin.dbCategories', ['sports' => $sports, 'sport_id' => $sport_id, 'sportname' => $sportname, 'cats' => $categoriesfiltered, 'dbcats' => Category::All()]);
        }
        else 
        {
            $dbcategoriesid = Category::All()->pluck('id');
            foreach($dbcategoriesid as $key => $value)
                $dbcategoriesid[$key] = 'sr:category:'.$value;

            $sports = Sport::All();

            return view('admin.dbCategories', ['sports' => $sports, 'sport_id' => $sport_id, 'dbcats' => Category::All()]);
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
        return redirect()->action(
                    'AdminController@dbCategories', ['sport_id' => $sport_id]
                );
        return redirect()->route('admin.db.categories')->with('sport_id', $sport_id);
    }
}