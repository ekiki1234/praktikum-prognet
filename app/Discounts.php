<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Discounts extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_product', 'percentage', 'start', 'end', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
}
