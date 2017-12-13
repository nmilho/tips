<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = ['id', 'scheduled', 'season', 'tournament', 'competitorh', 'competitora'];


    public function saveMatch($data)
	{
		$match = Match::find($data['id']);

		if($match == null)
		{
			$this->id = $data['id'];
			$this->scheduled = $data['scheduled'];
			$this->season = $data['season'];
			$this->tournament = $data['tournament'];
			$this->competitorh = $data['competitorh'];
			$this->competitora = $data['competitora'];
			$result = $this->save();
		}
		else 
		{
			$match->scheduled = $data['scheduled'];
			$match->season = $data['season'];
			$match->tournament = $data['tournament'];
			$match->competitorh = $data['competitorh'];
			$match->competitora = $data['competitora'];
			$result = $match->save();
		}

		return $result;
	}
}
