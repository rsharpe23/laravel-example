<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'text', 'href', 'target_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    // protected $hidden = [
    //     'target_id', 'created_at', 'updated_at',
    // ];

    // public function target() 
    // {
    //     return $this->belongsTo('App\LinkTarget');
    // }
}
