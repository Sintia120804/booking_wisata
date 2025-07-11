<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SintiaCategory extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function destinations()
    {
        return $this->hasMany(SintiaDestination::class, 'category_id');
    }
}
