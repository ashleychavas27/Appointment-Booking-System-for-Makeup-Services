<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'active',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
