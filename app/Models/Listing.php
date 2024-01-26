<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'user_id',
    ];

    // Define relationships, if any
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
