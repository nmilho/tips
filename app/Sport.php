<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    protected $fillable = ['id', 'name'];

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
