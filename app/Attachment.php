<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $hidden = [
        'uuid', 'created_at', 'updated_at',
    ];
}
