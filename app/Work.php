<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table = 'portfolio';

    protected $fillable = [
        'title', 
        'content', 
        'price', 
        'days_amount', 
        'type_id', 
        'attachment_id',
    ];

    protected $hidden = [
        'type_id', 'attachment_id', 'link_id',
    ];

    public function type()
    {
        return $this->belongsTo('App\WorkType');
    }

    public function link()
    {
        return $this->belongsTo('App\Link');
    }

    public function attachment()
    {
        return $this->belongsTo('App\Attachment');
    }
}
