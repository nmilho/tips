<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    protected $fillable = ['id', 'name'];

    /**
     * Returns the id as it cames from radar
     *
     * @param  string  $value
     * @return string
     */
    public function getIdAttribute($value)
    {
        return 'sr:sport:'.$value;
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




    /**
     * Saves a sport to the database table (creats or updates)
     *
     * @param  string  $value
     * @return bool
     */
    public function saveSport($data)
	{
		$data['id'] = ( (!strtok($data['id'], ':').strtok(':')) ? strtok(':') : $data['id'] );
		
		$sport = Sport::find($data['id']);

		if($sport == null)
		{
			$this->id = $data['id'];
			$this->name = $data['name'];
			$result = $this->save();
		}
		else 
		{
			$sport->name = $data['name'];
			$result = $sport->save();
		}

		return $result;
	}
}
