<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $appends = ['path'];


    public function getPathAttribute()
    {
        return 'storage/uploads/'.$this->name;
    }

    public function fragments()
    {
        return $this->hasMany('App\Models\Fragment');
    }

}
