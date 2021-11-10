<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class materiel extends Model
{
    public $timestamps = false;
    protected $fillable = ['codeqr','name','soustype', 'numserie', 'marque','vdp'];
}

