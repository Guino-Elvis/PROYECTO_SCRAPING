<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['url'];

    //relación polimorfica
    //Creamos la función con el mismo nombre que el campo
    public function imageable()
    {
        return $this->morphTo();
    }
}
