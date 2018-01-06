<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = ['id', 'name', 'sport_id', 'category_id', 'season_id'];


    public function saveTournament($data)
	{
		$data['id'] = ( (!strtok($data['id'], ':').strtok(':')) ? strtok(':') : $data['id'] ) ;
        $data['sport_id'] = ( (!strtok($data['sport_id'], ':').strtok(':')) ? strtok(':') : $data['sport_id'] ) ;
        $data['category_id'] = ( (!strtok($data['sport_id'], ':').strtok(':')) ? strtok(':') : $data['sport_id'] ) ;
        $data['season_id'] = ( (!strtok($data['sport_id'], ':').strtok(':')) ? strtok(':') : $data['sport_id'] ) ;
		
		$tournament = Tournament::find($data['id']);

		if($tournament == null)
		{
			$this->id = $data['id'];
			$this->name = $data['name'];
			$this->sport_id = $data['sport']['id'];
			$this->category_id = $data['category']['id'];
			$this->season_id = $data['current_season']['id'];
			$result = $this->save();
		}
		else 
		{
			$tournament->name = $data['name'];
			$tournament->sport_id = $data['sport']['id'];
			$tournament->category_id = $data['category']['id'];
			$tournament->season_id = $data['current_season']['id'];
			$result = $tournament->save();
		}

		return $result;
	}
}
