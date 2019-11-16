<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var arraylaravel
     */
    protected $fillable = [
        'title', 'externalId', 'posterPath', 'toWatch', 'watched'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
