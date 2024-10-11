<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'city_name',
        'prov_id'
    ];
    public function provincy()
    {
        return $this->belongsTo(Provincies::class, 'prov_id', 'id');
    }
    public function district()
    {
        return $this->hasMany(District::class, 'city_id', 'id');
    }
}
