<?php

namespace Frantz\Follow\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model 
{
	/**
     * relationship with the user model
     * @return [type] [description]
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }


    protected $fillable = ['user_id','user_being_followed_id']; 
}