<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FutureEvent extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'title',
        'sub_title',
        'description',
        'image',
        'event_date',
        'status',
        'order'
    ];
    protected $appends = array('img', 'shortDesc');

    public function getImgAttribute()
    {
        return $this->image;
    }

    public function getEventDayAttribute()
    {
        return Carbon::parse($this->event_date)->format('d-m-Y');
    }
    public function getShortDescAttribute()
    {
        return str::limit($this->description, 15, '...');
    }
}
