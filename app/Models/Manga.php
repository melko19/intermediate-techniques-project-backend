<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'genre',
        'price',
        'acquired_on'
    ];

    public function container() {
        return $this->belongsTo('App\Models\Manga', 'title', 'id');
    }
}
