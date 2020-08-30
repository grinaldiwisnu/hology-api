<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $table = 'teams';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'institution_id', 'competition_id', 'team_name', 'team_payment_proof', 'team_lead', 'team_status', 'team_join_url'
    ];

    public $timestamps = false;

    public function lead()
    {
        return $this->belongsTo('App\User', 'team_lead', 'user_id');
    }

    public function competition()
    {
        return $this->belongsTo('App\Competition', 'competition_id', 'competition_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'detail_teams', 'team_id', 'user_id');
    }
}
