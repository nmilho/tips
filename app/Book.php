<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
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
        return 'sr:book:'.$value;
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

    

    public function saveBook($data)
	{
		$data['id'] = filter_var($data['id'], FILTER_SANITIZE_NUMBER_INT);

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
