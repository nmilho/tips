<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['id', 'name', 'country_code', 'outrights', 'sport_id'];

    public function saveCategory($data)
	{
		$category = Category::find($data['id']);

		if($category == null)
		{
			$this->id = $data['id'];
			$this->name = $data['name'];
			$this->country_code = $data['country_code'];
			$result = $this->save();
		}
		else 
		{
			$category->name = $data['name'];
			$category->country_code = $data['country_code'];
			$result = $category->save();
		}

		return $result;
	}
}
