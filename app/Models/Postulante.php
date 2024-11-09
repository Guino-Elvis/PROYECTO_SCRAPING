<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'phone', 'name', 'paterno', 'materno', 'document', 'address', 'tdatos'];

    public function aplication()
    {
        return $this->hasMany(Application::class);
    }
}
