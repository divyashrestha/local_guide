<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    /** @use HasFactory<\Database\Factories\PlaceFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'categories', 'latitude', 'longitude',
        'country', 'city', 'images', 'user_id'
    ];

    protected $casts = ['images' => 'array' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class, PlaceCategory::class);
    }

}
