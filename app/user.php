<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    public $timestamps = false;
    protected $fillable = ['login', 'password','type','etat'];
}
