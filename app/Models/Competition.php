<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{

    protected $table = 'competitions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'competition_id', 'competition_name', 'competition_description',
    ];

    public $timestamps = false;

    public function team()
    {
        return $this->hasMany('App\Team', 'competition_id', 'competition_id');
    }
}
