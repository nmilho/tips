<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['id', 'name'];

    public function saveBook($data)
	{
		$data['id'] = ( (!strtok($data['id'], ':').strtok(':')) ? strtok(':') : $data['id'] );

		$book = Book::find($data['id']);

		if($book == null)
		{
			$this->id = $data['id'];
			$this->name = $data['name'];
			$result = $this->save();
		}
		else 
		{
			$book->id = $data['id'];
			$book->name = $data['name'];
			$result = $book->save();
		}

		return $result;
	}
}
