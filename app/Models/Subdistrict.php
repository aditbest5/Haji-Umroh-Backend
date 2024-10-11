<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'subdis_name',
        'subdis_id'
    ];
    
    public function city()
    {
        return $this->belongsTo(Subdistrict::class, 'subdis_id', 'id');
    }
}
