<?php

namespace App\Http\Controllers\db;

use Illuminate\Http\Request;
use App\Sport;
use App\Season;
use App\Competitor;
use App\Category;
use App\Tournament;
use App\Match;
use App\Book;
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
                    'tournaments' => Tournament::All()->count(),
                    'categories' => Category::All()->count(),
                    'sports' => Sport::All()->count(),
                    'matches' => Match::All()->count(),
                    ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function books()
    {
        $radarurl = 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/books.json?api_key=';
        $request = $radarurl.env('SPORTRADAR_KEY_ODD_ROW');

        $jsondata = file_get_contents($request);
        $json = json_decode(utf8_decode($jsondata), true);

        $books = collect($json['books']);
        
        $booksDb = Book::All();
        $booksIdDb = $booksDb->pluck('id');

        foreach($booksIdDb as $key => $value)
            $booksIdDb[$key] = 'sr:book:'.$value;
        
        $books = $books->whereNotIn('id', $booksIdDb);

        return view('admin.db.books', ['booksDb' => $booksDb->sortBy('name'), 'books' => $books->sortBy('name')]);
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return string
     */
    public function updatebooks(Request $request)
    {

        $rules = array (
                'fname' => 'required|alpha'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (             
                    'errors' => $validator->getMessageBag ()->toArray () 
            ) );
        else {
            
            $data = Book::find ( $request->id );
            $data->name = ($request->fname);
            $data->save ();
            return response ()->json ( $data );
        }

        /*if($request)
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
        return redirect()->route('admin.db.sports');*/
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return string
     */
    public function deletebooks(Request $request)
    {


        Book::find ( $request->id )->delete();
        return response()->json();

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function sports()
    {

        $radarurl = 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/sports.json?api_key=';
        $request = $radarurl.env('SPORTRADAR_KEY_ODD_ROW');

        $jsondata = file_get_contents($request);
        $json = json_decode(utf8_decode($jsondata), true);

        $sports = collect($json['sports']);
        
        $sportsDb = Sport::All();
        $sportsIdDb = $sportsDb->pluck('id');

        foreach($sportsIdDb as $key => $value)
            $sportsIdDb[$key] = 'sr:sport:'.$value;
        
        $sports = $sports->whereNotIn('id', $sportsIdDb);

        return view('admin.db.sports', ['sportsDb' => $sportsDb->sortBy('name'), 'sports' => $sports->sortBy('name')]);
    }
}