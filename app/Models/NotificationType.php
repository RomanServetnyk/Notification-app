<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notifications');
    }
}
