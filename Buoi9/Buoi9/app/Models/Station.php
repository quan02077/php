<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Station extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['station_name', 'address', 'ward', 'total_docks', 'status'];

    public function bicycles(){
        return $this->hasMany(Bicycle::class);
    }

    public function rentalsFrom(){
        return $this->hasMany(Rental::class, 'rent_station_id');
    }

    public function rentalsTo(){
        return $this->hasMany(Rental::class,'return_station_id');
    }

    public function reviews(){
        return $this->hasMany(StationReview::class);
    }

    // Accessors hỗ trợ tính toán trong view & controller
    public function getBikeCountAttribute() {
        return $this->attributes['bike_count'] 
            ?? ($this->attributes['bicycles_count'] 
            ?? $this->bicycles()->count());
    }

    public function getRentalsFromCountAttribute() {
        return $this->attributes['rentals_from_count'] 
            ?? ($this->attributes['rentalsFrom_count'] 
            ?? 0);
    }

    public function getRentalsToCountAttribute() {
        return $this->attributes['rentals_to_count'] 
            ?? ($this->attributes['rentalsTo_count'] 
            ?? 0);
    }
}
