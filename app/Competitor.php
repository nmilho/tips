<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    protected $fillable = ['id', 'name', 'country', 'country_code', 'abbreviation'];


    public function saveCompetitor($data)
	{
		$competitor = Competitor::find($data['id']);

		if($competitor == null)
		{
			$this->id = $data['id'];
			$this->name = $data['name'];
			$this->country = $data['country'];
			$this->country_code = $data['country_code'];
			$this->abbreviation = $data['abbreviation'];
			$result = $this->save();
		}
		else 
		{
			$competitor->name = $data['name'];
			$competitor->country = $data['country'];
			$competitor->country_code = $data['country_code'];
			$competitor->abbreviation = $data['abbreviation'];
			$result = $competitor->save();
		}

		return $result;
	}
}
