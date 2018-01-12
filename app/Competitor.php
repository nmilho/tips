<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    protected $fillable = ['id', 'name', 'country', 'country_code', 'abbreviation'];

    /**
     * Returns the id as it cames from radar
     *
     * @param  string  $value
     * @return string
     */
    public function getIdAttribute($value)
    {
        return 'sr:competitor:'.$value;
    }

    /**
     * Set the id as integer (without the xx:xxxxxx part)
     *
     * @param  string  $value
     * @return void
     */
    public function setIdAttribute($value)
    {
        $this->attributes['id'] = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }


    public function saveCompetitor($data)
	{
		$data['id'] = ( (!strtok($data['id'], ':').strtok(':')) ? strtok(':') : $data['id'] ) ;

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
