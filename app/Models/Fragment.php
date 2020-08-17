<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fragment extends Model
{
    protected $appends = ['path'];


    public function getPathAttribute()
    {
        return 'storage/uploads/'.$this->name;
    }
}
