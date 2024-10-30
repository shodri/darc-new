<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landing extends Model
{
    use HasFactory;

    protected $dates = ['start_date', 'expiration_date'];
    protected $fillable = [
        'title',
        'content',
        'url',
        'site_base',
        'value_1',
        'value_2',
        'start_date',
        'expiration_date',
    ];

}
