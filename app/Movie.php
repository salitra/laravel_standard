<?php

namespace App;
use Carbon;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
	protected $fillable = [
        'name', 'release_date', 'genre_id',
    ];
    protected $dates = [
        'release_date',
    ];
    //Relationship with genres table
    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }
    //Relationship with images table
    public function images()
    {
        return $this->hasMany('App\Image');
    }
    //For date format of release date
    public function getReleaseDateAttribute($name='')
    {
        return (new Carbon\Carbon($this->attributes['release_date']))->format('d-M-Y');
    }
    //For name format
    public function getNameAttribute($name='')
    {
        return ucfirst($this->attributes['name']);
    }
}
