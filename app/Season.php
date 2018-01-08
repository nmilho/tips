<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable = ['id', 'name', 'start_date', 'end_date', 'year'];
    public function saveSeason($data)
	{
		$data['id'] = ( (!strtok($data['id'], ':').strtok(':')) ? strtok(':') : $data['id'] ) ;
		$season = Season::find($data['id']);
		if($season == null)
		{
			$this->id = $data['id'];
			$this->name = $data['name'];
			$this->start_date = $data['start_date'];
			$this->end_date = $data['end_date'];
			$this->year = $data['year'];
			$result = $this->save();
		}
		else 
		{
			$season->name = $data['name'];
			$season->start_date = $data['start_date'];
			$season->end_date = $data['end_date'];
			$season->year = $data['year'];
			$result = $season->save();
		}
		return $result;
	}
}
