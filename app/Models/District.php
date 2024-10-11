<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'dis_name',
        'city_id'
    ];
    
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function subdistrict()
    {
        return $this->hasMany(Subdistrict::class, 'dis_id', 'id');
    }
}
