<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function portfolio() 
    {
        return $this->hasMany('App\Work');
    }
}
