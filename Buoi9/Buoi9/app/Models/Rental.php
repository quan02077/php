<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'bicycle_id', 'rent_station_id', 'return_station_id', 'rented_at', 'returned_at', 'price_per_hour', 'total_hours', 'total_amount'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bicycle(){
        return $this->belongsTo(Bicycle::class);
    }

    public function rentStation(){
        return $this->belongsTo(Station::class, 'rent_station_id');
    }

    public function returnStation(){
        return $this->belongsTo(Station::class,'return_station_id');
    }
}
