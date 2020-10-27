<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{

    protected $table = 'academy';

    protected $primaryKey = 'academy_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'academy_resume', 'academy_payment_proof', 'academy_status', 'academy_phone_number'
    ];

    public $timestamps = false;

    public function users()
    {
        return $this->hasOne('App\User', 'user_id', 'user_id');
    }
}
