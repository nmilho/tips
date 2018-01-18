<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = ['id', 'scheduled', 'start_time_tbd', 'status', 'tournament_round', 'season_id', 'tournament_id', 'sport_id', 'category_id', 'competitor_home_id', 'competitor_away_id'];


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
     * Set the id as integer (without the xx:xxxxxx part)
     *
     * @param  string  $value
     * @return void
     */
    public function setCompetitorHomeIdIdAttribute($value)
    {
        $this->attributes['competitor_home_id'] = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Set the id as integer (without the xx:xxxxxx part)
     *
     * @param  string  $value
     * @return void
     */
    public function setCompetitorAwayIdIdAttribute($value)
    {
        $this->attributes['competitor_away_id'] = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }




    /**
     * Get the season record associated with the match.
     */
    public function season()
    {
        return $this->belongsTo('App\Season');
    }

    /**
     * Get the tournament record associated with the match.
     */
    public function tournament()
    {
        return $this->belongsTo('App\Tournament');
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


    /**
     * Get the home competitor record associated with the match.
     */
    public function competitor_home()
    {
        return $this->belongsTo('App\Competitor');
    }

    /**
     * Get the away competitor record associated with the match.
     */
    public function competitor_away()
    {
        return $this->belongsTo('App\Competitor');
    }

    
    
    public function saveMatch($data)
	{
		/*$data['id'] = ( (!strtok($data['id'], ':').strtok(':')) ? strtok(':') : $data['id'] );
		$data['tournament']['id'] = ( (!strtok($data['tournament']['id'], ':').strtok(':')) ? strtok(':') : $data['tournament']['id'] );
        $data['tournament']['sport']['id'] = ( (!strtok($data['tournament']['sport']['id'], ':').strtok(':')) ? strtok(':') : $data['tournament']['sport']['id'] );
        $data['season']['id'] = ( (!strtok($data['season']['id'], ':').strtok(':')) ? strtok(':') : $data['season']['id'] );
        $data['tournament']['category']['id'] = ( (!strtok($data['tournament']['category']['id'], ':').strtok(':')) ? strtok(':') : $data['tournament']['category']['id'] );

        $data['competitors'][0]['id'] = ( (!strtok($data['competitors'][0]['id'], ':').strtok(':')) ? strtok(':') : $data['competitors'][0]['id'] );
        $data['competitors'][1]['id'] = ( (!strtok($data['competitors'][1]['id'], ':').strtok(':')) ? strtok(':') : $data['competitors'][1]['id'] );*/

		$match = Match::find($data['id']);

		if($match == null)
		{
			$this->id = $data['id'];
			$this->scheduled = $data['scheduled'];
			$this->season_id = $data['season']['id'];
			$this->tournament_id = $data['tournament']['id'];
			$this->sport_id = $data['tournament']['sport']['id'];
			$this->category_id = $data['tournament']['category']['id'];
			$this->competitor_home_id = $data['competitors'][0]['id'];
			$this->competitor_away_id = $data['competitors'][1]['id'];
			$result = $this->save();
		}
		else 
		{
			$match->scheduled = $data['scheduled'];
			$match->season_id = $data['season']['id'];
			$match->tournament_id = $data['tournament']['id'];
			$match->sport_id = $data['tournament']['sport']['id'];
			$match->category_id = $data['tournament']['category']['id'];
			$match->competitor_home_id = $data['competitors'][0]['id'];
			$match->competitor_away_id = $data['competitors'][1]['id'];
			$result = $match->save();
		}

		return $result;
	}
}
