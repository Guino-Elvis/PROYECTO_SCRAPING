<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaLaboral extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'ubicacion',
        'remuneracion',
        'descripcion',
        'body',
        'fecha_inicio',
        'fecha_fin',
        'limite_postulante',
        'documentos_oferta',
        'state',
        'empresa_id',
        'category_id',
        'user_id'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    //Relación 1 a * inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relación 1 a *
    public function aplication()
    {
        return $this->hasMany(Application::class);
    }
}
