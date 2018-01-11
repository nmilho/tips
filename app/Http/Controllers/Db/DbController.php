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
use File;
use Validator;

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
        /*$radarurl = 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/books.json?api_key=';
        $request = $radarurl.env('SPORTRADAR_KEY_ODD_ROW');

        $jsondata = file_get_contents($request);
        $json = json_decode(utf8_decode($jsondata), true);*/
        $path = storage_path().'\json\books.json'; // ie: /var/www/laravel/app/storage/json/filename.json
        
        if (!File::exists($path)) {
            return dd($path);
        }

        $file = File::get($path); // string
        //return dd($file);

        $json = json_decode(utf8_decode($file), true);

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
            'name' => 'required'
        );

        $validator = Validator::make ( $request->toArray(), $rules );

        if ($validator->fails ())
            return response()->json( array('errors' => $validator->getMessageBag()->toArray()) );

        else {
            if($request)
            {
                $book = new Book;
                $res = $book->saveBook( $request );
                return response ()->json( $res );
            }
        }
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
        /*$radarurl = 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/sports.json?api_key=';
        $request = $radarurl.env('SPORTRADAR_KEY_ODD_ROW');

        $jsondata = file_get_contents($request);
        $json = json_decode(utf8_decode($jsondata), true);*/
        $path = storage_path().'\json\sports.json'; // ie: /var/www/laravel/app/storage/json/filename.json
        
        if (!File::exists($path)) {
            return dd($path);
        }

        $file = File::get($path); // string
        $json = json_decode(utf8_decode($file), true);

        $sports = collect($json['sports']);
        
        $sportsDb = Sport::All();
        $sportsIdDb = $sportsDb->pluck('id');

        foreach($sportsIdDb as $key => $value)
            $sportsIdDb[$key] = 'sr:sport:'.$value;
        
        $sports = $sports->whereNotIn('id', $sportsIdDb);

        return view('admin.db.sports', ['sportsDb' => $sportsDb->sortBy('name'), 'sports' => $sports->sortBy('name')]);
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return string
     */
    public function updatesports(Request $request)
    {
        $rules = array (
            'name' => 'required'
        );

        $validator = Validator::make ( $request->toArray(), $rules );

        if ($validator->fails ())
            return response()->json( array('errors' => $validator->getMessageBag()->toArray()) );

        else {
            if($request)
            {
                $sport = new Sport;
                $res = $sport->saveSport( $request );
                return response ()->json( $res );
            }
        }
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return string
     */
    public function deletesports(Request $request)
    {


        Sport::find ( $request->id )->delete();
        return response()->json();

    }
}