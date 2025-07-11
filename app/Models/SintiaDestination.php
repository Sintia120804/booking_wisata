<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SintiaDestination extends Model
{
    protected $fillable = [
        'name', 'category_id', 'location', 'description', 'price', 'image'
    ];

    public function category()
    {
        return $this->belongsTo(SintiaCategory::class, 'category_id');
    }

    public function bookings()
    {
        return $this->hasMany(SintiaBooking::class, 'destination_id');
    }

    public function reviews()
    {
        return $this->hasMany(SintiaReview::class, 'destination_id');
    }
}
