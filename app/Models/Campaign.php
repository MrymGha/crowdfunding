<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'goal_amount',
        'current_amount',
        'user_id',
        'photo',
        'paypal_account',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
