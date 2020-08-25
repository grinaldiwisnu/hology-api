<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{

    protected $table = 'institution';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'institution_id', 'institution_name',
    ];

    public $timestamps = false;
}
