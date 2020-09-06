<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{

    protected $table = 'institutions';

    protected $primaryKey = 'institution_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'institution_name',
    ];

    public $timestamps = false;
}
