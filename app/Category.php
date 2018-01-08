<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['id', 'name', 'country_code', 'outrights', 'sport_id'];


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
