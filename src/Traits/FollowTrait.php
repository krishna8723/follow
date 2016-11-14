<?php

namespace Frantz\Follow\Traits;

use Frantz\Follow\Models\Follow;



/**
* A follow-trait consumed by the User class
*/
trait FollowTrait {


    /**
     * follow a user 
     * @param  [type] $id [id of user being followed]
     * @return [type]     [follow instance]
     */
    public function follow($id)
    {
        $follow = Follow::create([
            'user_id' => Auth::id(),
            'user_being_followed_id' => $id
        ]);
        return true;
    }

    /**
     * unfollow a user
     * @param  [type] $id id of the user being unfollowed
     * @return [type]     [description]
     */
    public function unfollow($id)
    {
        $follow = Follow::where('user_being_followed_id', $id)
                                ->where('user_id', $this->id)
                                ->first();
        $follow->delete();
        return true;
    }   

	/**
     * get all the users following this user
     * @return [type] [description]
     */
    public function all_followers()
    {
        $follow_instances =  Follow::where('user_being_followed_id', $this->id)
                        ->get();
        $followers = [];

        foreach($follow_instances as $follow)
        {
            array_push($followers, $follow->user);
        }
        return $followers;
    }

    /**
     * get all the users this->user is following
     * @return [type] [description]
     */
    public function all_following()
    {
        $follow_instances =  Follow::where('user_id', $this->id)
                    ->get();
        $following = array();

        foreach($follow_instances as $follow)
        {
            array_push($following, $follow->user);
        }
        return $following;
    }

    /**
     * return all followers id's
     * @return [type] [description]
     */
    public function all_followers_ids()
    {
        $follow_instances =  Follow::where('user_being_followed_id', $this->id)
                        ->get();
        $followers_ids = [];

        foreach($follow_instances as $follow)
        {
            array_push($followers_ids, $follow->user()->pluck('id')->all()[0]);
        }
        return $followers_ids;

    }

    /**
     * get all the ids of all the users this->user is following
     * @return [type] [description]
     */
    public function all_following_ids()
    {
        $follow_instances =  Follow::where('user_id', $this->id)
                    ->get();
        $following = array();

        foreach($follow_instances as $follow)
        {
            array_push($following, 
                $this->where('id', $follow->user_being_followed_id)
                                      ->pluck('id')
                                      ->all()[0]);
        }
        return $following;
    }

    /**
     * check if $this->user is following the user with id , id
     * @param  [type]  $id [id of user who might be following $this->user]
     * @return boolean     [true or false]
     */
    public function is_following($id)
    {
        if(in_array($id, $this->all_following_ids()))
        {
            return true;
        }
        return false;
    }

    /**
     * check if this->user is followed by user with id id 
     * @param  [type]  $id [description]
     * @return boolean     [description]
     */
	public function is_followed_by($id)
    {
        if(in_array($id, $this->all_followers_ids()))
        {
            return true;
        }
        return false;
    }

    /**
     * return number of users following this->user
     * @return [type] [description]
     */
    public function all_followers_count()
    {
        return count($this->all_followers_ids());
    }
    /**
     * return number of users this->user is following
     * @return [type] [description]
     */
    public function all_following_count()
    {
        return count($this->all_following_ids());
    }
	
}