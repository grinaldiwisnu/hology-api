<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_fullname', 'user_email', 'user_name', 'user_password', 'user_gender', 'user_birthdate', 'institution_id'
    ];

    public $timestamps = false;
}
