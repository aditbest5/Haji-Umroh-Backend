<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];

    public function user()
    {
        $this->hasMany(User::class, 'role_id', 'id');
    }
}
