<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilgrim extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'nik',
        'birthday_place',
        'birthday_date',
        'address',
        'gender',
        'no_passport',
        'period_passport',
        'ktp_photo',
        'kk_photo',
        'package',
        'room',
        'selfie_photo',
        'passport_photo',
        'no_visa',
        'period_visa',
        'prov_id',
        'city_id',
        'dis_id',
        'subdis_id',
    ];

    public function user()
    {
        $this->hasMany(User::class, 'role_id', 'id');
    }
}
