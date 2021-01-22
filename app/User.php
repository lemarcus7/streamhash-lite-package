<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type','device_type','login_by','picture','is_activated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userHistory()
    {
        return $this->hasMany('App\UserHistory');
    }

    public function userRating()
    {
        return $this->hasMany('App\UserRating');
    }

    public function userWishlist()
    {
        return $this->hasMany('App\Wishlist');
    }

    public function userPayment()
    {
        return $this->hasMany('App\UserPayment');
    }

    public static function boot()
    {
        //execute the parent's boot method 
        parent::boot();

        //delete your related models here, for example
        static::deleting(function($user)
        {

            foreach($user->userHistory as $history)
            {
                $history->delete();
            } 

            foreach($user->userRating as $rating)
            {
                $rating->delete();
            } 

            foreach($user->userWishlist as $wishlist)
            {
                $wishlist->delete();
            } 

            foreach($user->userPayment as $payment)
            {
                $payment->delete();
            } 
        }); 

    }

}
