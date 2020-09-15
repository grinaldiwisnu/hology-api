<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{

    protected $table = 'submissions';

    protected $primaryKey = 'submission_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id', 'submission_link', 'submission_phase'
    ];

    public $timestamps = true;

}
