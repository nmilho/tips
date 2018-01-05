<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable = ['id', 'name', 'start_date', 'end_date', 'year'];

    public function saveSeason($data)
	{
		$season = Season::find($data['id']);

		if($season == null)
		{
			$this->id = $data['id'];
			$this->name = $data['name'];
			$result = $this->save();
		}
		else 
		{
			$season->name = $data['name'];
			$result = $season->save();
		}

		return $result;
	}
}
