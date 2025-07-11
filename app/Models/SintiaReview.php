<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SintiaDestination;
use App\Models\User;

class SintiaReview extends Model
{
    protected $fillable = [
        'user_id', 'destination_id', 'rating', 'comment'
    ];

    public function destination()
    {
        return $this->belongsTo(SintiaDestination::class, 'destination_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
