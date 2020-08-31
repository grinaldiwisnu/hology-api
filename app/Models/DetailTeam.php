<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTeam extends Model
{

    protected $table = 'detail_teams';

    protected $primaryKey = 'detail_team_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'team_id',
    ];

    public $timestamps = false;
}
