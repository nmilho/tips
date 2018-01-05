<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = ['id', 'name', 'sport_id', 'category_id', 'season_id'];


    public function saveTournament($data)
	{
		$tournament = Tournament::find($data['id']);

		if($tournament == null)
		{
			$this->id = $data['id'];
			$this->name = $data['name'];
			$this->sport = $data['sport']['id'];
			$this->category = $data['category']['id'];
			$result = $this->save();
		}
		else 
		{
			$tournament->name = $data['name'];
			$tournament->sport = $data['sport']['id'];
			$tournament->category = $data['category']['id'];
			$result = $tournament->save();
		}

		return $result;
	}
}
