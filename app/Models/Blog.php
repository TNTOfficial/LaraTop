<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'image', 'content'
    ];

    protected $appends = array('img', 'shortMsg');

    public function getImgAttribute()
    {
        return $this->image;
    }

    public function getShortMsgAttribute()
    {
        return Str::limit($this->content, 15, '...');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
