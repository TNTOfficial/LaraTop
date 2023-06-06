<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $fillable = [
        'value',
        'status'
    ];
}
