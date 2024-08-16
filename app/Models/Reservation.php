<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Reservation extends Model
{
    use HasFactory,Notifiable,HasApiTokens;
    protected $fillable = [
        'room_id',
        'number_of_seats',
        'reserved_at',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
