<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sport;
use App\Season;
use App\Competitor;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'test']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function test(Request $request)
    {

        $sportid = 1;
        if($request->sportdd)
        {
            $sportid = $request->sportdd;
        }
        $jsonurl = 'https://api.sportradar.us/oddscomparison-rowt1/en/eu/categories.json?api_key='.env('SPORTRADAR_KEY_ODD_ROW');            

        $jsondata = file_get_contents($jsonurl);
        $json = json_decode(utf8_decode($jsondata), true);
        $categories = collect((isset($json['categories']) ? $json['categories'] : null));

        $catsColl = collect($categories);

        return dd($categories, $catsColl->where('sport_id', 'sr:sport:2')->where('id', 'sr:category:15'));

        /********
        *
        *
        $tournaments = collect([

            ['id' => 'sr:tournament:7', 'name' => 'Championship', 'sport' => ['id' => 'sr:sport:1', 'name' => 'Futebol'], 'category' => ['id' => 'sr:category:1', 'name' => 'Inglaterra']
            ],
            ['id' => 'sr:tournament:8', 'name' => 'La Liga', 'sport' => ['id' => 'sr:sport:1', 'name' => 'Futebol'], 'category' => ['id' => 'sr:category:32', 'name' => 'Espanha', 'country_code' => 'ESP']
            ],
            ['id' => 'sr:tournament:17', 'name' => 'Liga dos Andebois UEFA', 'sport' => ['id' => 'sr:sport:2', 'name' => 'Andebol'], 'category' => ['id' => 'sr:category:313', 'name' => 'Andebois Internacionais']
            ],
            ['id' => 'sr:tournament:23', 'name' => 'Premiere League', 'sport' => ['id' => 'sr:sport:1', 'name' => 'Futebol'], 'category' => ['id' => 'sr:category:1', 'name' => 'Inglaterra']
            ],
        ])->filter(function($item) {
            return $item['category']['name'] == 'Inglaterra';
        })->sortBy('name')->values()->all();

        return dd($tournaments);

        $collection = collect([
            ['id' => 1, 'name' => 'John Doe', 'sex' => 'male'],
            ['id' => 2, 'name' => 'Jane Doe', 'sex' => 'female'],
            ['id' => 3, 'name' => 'Jack Doe', 'sex' => 'male'],
        ]);

        $collectionFiltered = collect([
            ['id' => 1, 'name' => 'John Doe', 'sex' => 'male'],
            ['id' => 2, 'name' => 'Jane Doe', 'sex' => 'female'],
            ['id' => 3, 'name' => 'Jack Doe', 'sex' => 'male'],
        ])->filter(function($item) {
            return $item['sex'] == 'male';
        })->sortBy('name')->values()->all();

        return dd($collection, $collectionFiltered);
        *
        ****/

    }
}
