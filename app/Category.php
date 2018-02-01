<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['id', 'name', 'outrights', 'sport_id'];

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
     * Set the sport_id as integer (without the xx:xxxxxx part)
     *
     * @param  string  $value
     * @return void
     */
    public function setSportIdAttribute($value)
    {
        $this->attributes['sport_id'] = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }




    /**
     * Get the sport record associated with the match.
     */
    public function sport()
    {
        return $this->belongsTo('App\Sport');
    }




    public function saveCategory($data)
	{
        /*$data['id'] = ( (!strtok($data['id'], ':').strtok(':')) ? strtok(':') : $data['id'] ) ;
        $data['sport_id'] = ( (!strtok($data['sport_id'], ':').strtok(':')) ? strtok(':') : $data['sport_id'] ) ;*/
		$category = Category::find($data['id']);

		if($category == null)
		{
			$this->id = $data['id'];
			$this->name = $data['name'];
			$this->country_code = (isset($data['country_code']) ? $data['country_code'] : '');
            $this->outrights = (isset($data['outrights']) ? $data['outrights'] : '');
            $this->sport_id = (isset($data['sport_id']) ? $data['sport_id'] : '');
			$result = $this->save();
		}
		else 
		{
			$category->name = $data['name'];
			$category->country_code = (isset($data['country_code']) ? $data['country_code'] : '');
            $category->outrights = (isset($data['outrights']) ? $data['outrights'] : '');
            $category->sport_id = (isset($data['sport_id']) ? $data['sport_id'] : '');
			$result = $category->save();
		}

		return $result;
	}
}
