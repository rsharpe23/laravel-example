<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'primary_text', 
        'secondary_text', 
        'github', 
        'vk', 
        'email', 
        'skype',
        'attachment_id',
    ];

    protected $hidden = [
        'attachment_id',
    ];

    public function attachment() 
    {
        return $this->belongsTo('App\Attachment');
    }
}
