<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // Table Name
    protected $table = 'profiles';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;


    public function user(){
        return $this->belongsTo('App\User');
    }
}
