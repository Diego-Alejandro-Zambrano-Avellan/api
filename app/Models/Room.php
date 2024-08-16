<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Room extends Model
{
    use HasFactory,Notifiable,HasApiTokens;
    protected $fillable = [
        'cinema_id',
        'room_number',
        'total_seats',
        'available_seats',
        'movie_title',
    ];

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    // Relación con el modelo Reservation
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
