<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'numero',
        'fecha_postulacion',
        'documentos',
        'postulante_id',
        'user_id',
        'oferta_laboral_id'
    ];

    public function oferta_laboral()
    {
        return $this->belongsTo(OfertaLaboral::class);
    }

    public function postulante()
    {
        return $this->belongsTo(Postulante::class);
    }

    // Relación de * a uno
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
