<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_fullname', 'user_email', 'user_name', 'user_password', 'user_gender', 'user_birthdate', 'institution_id', 'team_id',
    ];

    public $timestamps = false;

    public function team()
    {
        return $this->hasOne('App\Team', 'team_lead', 'user_id');
    }

    public function teams()
    {
        return $this->belongsToMany('App\Team', 'detail_teams', 'user_id', 'team_id');
    }
}
