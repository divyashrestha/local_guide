<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceCategory extends Model
{
    protected $fillable = ['place_id', 'category_id'];

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function place()
    {
        return $this->belongsToMany(Place::class);
    }
}
