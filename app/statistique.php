<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class statistique extends Model
{
    public $timestamps = false;
    protected $fillable = ['vdp','soustype', 'count'];
}

