<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['id', 'name', 'country_code', 'outrights', 'sport_id'];


    /**
     * Get the category's id.
     *
     * @param  int  $value
     * @return string
     *
    public function getIdAttribute($value)
    {
        return 'sr:category:'.$value;
    }

    /**
     * Set the category's id.
     *
     * @param  int  $value
     * @return void
     *
    public function setIdAttribute($value)
    {
        $this->attributes['id'] = ( (!strtok($value, ':').strtok(':')) ? strtok(':') : $value ) ;
    }


    /**
     * Get the category's sport_id.
     *
     * @param  int  $value
     * @return string
     *
    public function getSportIdAttribute($value)
    {
        return 'sr:sport:'.$value;
    }

    /**
     * Set the category's sport_id.
     *
     * @param  int  $value
     * @return void
     *
    public function setSportIdAttribute($value)
    {
        $this->attributes['sport_id'] = ( (!strtok($value, ':').strtok(':')) ? strtok(':') : $value ) ;
    }
*/




    public function saveCategory($data)
	{
        $data['id'] = ( (!strtok($data['id'], ':').strtok(':')) ? strtok(':') : $data['id'] ) ;
        $data['sport_id'] = ( (!strtok($data['sport_id'], ':').strtok(':')) ? strtok(':') : $data['sport_id'] ) ;
		$category = Category::find($data['id']);

		if($category == null)
		{
			$this->id = $data['id'];
			$this->name = $data['name'];
			$this->country_code = (isset($data['country_code']) ? $data['country_code'] : '');
            $this->outrights = $data['outrights'];
            $this->sport_id = $data['sport_id'];
			$result = $this->save();
		}
		else 
		{
			$category->name = $data['name'];
			$category->country_code = (isset($data['country_code']) ? $data['country_code'] : '');
            $category->outrights = $data['outrights'];
            $category->sport_id = $data['sport_id'];
			$result = $category->save();
		}

		return $result;
	}
}
