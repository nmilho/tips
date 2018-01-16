<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = ['id', 'name', 'sport_id', 'category_id', 'season_id'];


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
     * Set the id as integer (without the xx:xxxxxx part)
     *
     * @param  string  $value
     * @return void
     */
    public function setSportIdAttribute($value)
    {
        $this->attributes['sport_id'] = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Set the id as integer (without the xx:xxxxxx part)
     *
     * @param  string  $value
     * @return void
     */
    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Set the id as integer (without the xx:xxxxxx part)
     *
     * @param  string  $value
     * @return void
     */
    public function setSeasonIdAttribute($value)
    {
        $this->attributes['season_id'] = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }




    /**
     * Get the season record associated with the match.
     */
    public function season()
    {
        return $this->belongsTo('App\Season');
    }

    /**
     * Get the sport record associated with the match.
     */
    public function sport()
    {
        return $this->belongsTo('App\Sport');
    }

    /**
     * Get the category record associated with the match.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    



    public function saveTournament($data)
	{
		/*$data['id'] = ( (!strtok($data['id'], ':').strtok(':')) ? strtok(':') : $data['id'] ) ;
        $data['sport']['id'] = ( (!strtok($data['sport']['id'], ':').strtok(':')) ? strtok(':') : $data['sport']['id'] ) ;
        $data['category']['id'] = ( (!strtok($data['category']['id'], ':').strtok(':')) ? strtok(':') : $data['category']['id'] ) ;
        $data['current_season']['id'] = ( (!strtok($data['current_season']['id'], ':').strtok(':')) ? strtok(':') : $data['current_season']['id'] ) ;*/
		
		$tournament = Tournament::find($data['id']);
		if($tournament == null)
		{
			$this->id = $data['id'];
			$this->name = $data['name'];
			$this->sport_id = $data['sport']['id'];
			$this->category_id = $data['category']['id'];
			$this->season_id = $data['current_season']['id'];
			$result = $this->save();
		}
		else 
		{
			$tournament->name = $data['name'];
			$tournament->sport_id = $data['sport']['id'];
			$tournament->category_id = $data['category']['id'];
			$tournament->season_id = $data['current_season']['id'];
			$result = $tournament->save();
		}
		return $result;
	}
}
