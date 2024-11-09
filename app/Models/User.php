<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'names',
        'email',
        'email_verified_at',
        'apellido_p',
        'apellido_m',
        'dni',
        'direccion',
        'telefono',
        'password',
        'avatar',
        'external_id',
        'external_auth',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($user) {
    //         // Verificar el email automáticamente al crear un nuevo usuario
    //         $user->email_verified_at = now();
    //     });

    //     // static::created(function ($user) {
    //     //     // Asignar el rol de "Cliente" al usuario creado
    //     //     $user->assignRole('Cliente');
    //     // });
    // }


    //Relación de 1 a *
    public function Aplication()
    {
        return $this->hasMany(Application::class);
    }


    public function postulante()

    {
        return $this->hasMany(Postulante::class);
    }

    public function oferta_laboral()

    {
        return $this->hasMany(OfertaLaboral::class);
    }

    public function empresas()

    {
        return $this->hasMany(Empresa::class);
    }
}
