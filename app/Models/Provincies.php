<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincies extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'city_name',
    ];

    public function city()
    {
        $this->hasMany(City::class, 'prov_id', 'id');
    }
}
