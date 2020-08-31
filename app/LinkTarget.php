<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkTarget extends Model
{
    protected $fillable = [
        'name',
    ];

    public function links() 
    {
        // Переопределяем первичный ключ, т.к. он с не стандартным названием
        return $this->hasMany('App\Link', 'target_id');
    }
}
