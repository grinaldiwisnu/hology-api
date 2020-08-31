<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'users';

    protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_fullname', 'user_email', 'user_name', 'user_password', 'user_gender', 'user_birthdate', 'institution_id', 'team_id',
    ];

    protected $hidden = ['user_password'];

    public $timestamps = false;

    public function teams()
    {
        return $this->belongsToMany('App\Team', 'detail_teams', 'user_id', 'team_id');
    }
}
