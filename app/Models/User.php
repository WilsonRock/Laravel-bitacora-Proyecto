<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuid, HasApiTokens, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombres',
        'apellidos',
        'email',
        'password',
        'estado_id',
        'documento',
        'telefono'
    ];

    protected $dates = ['deleted_at'];


    public function setNombresAttrribute($valor)
    {
        $this->attributes['nombres'] = strtolower($valor);
    }

    public function setApellidosAttrribute($valor)
    {
        $this->attributes['apellidos'] = strtolower($valor);
    }

    public function setEmailAttrribute($valor)
    {
        $this->attributes['email'] = strtolower($valor);
    }

    public function getNombresAttribute($valor)
    {
        return ucwords($valor);
    }

    public function getApellidosAttribute($valor)
    {
        return ucwords($valor);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function estado()
    {
        return $this->belongsTo(\App\Models\Estado::class);
    }

    public function plazas()
    {
        return $this->belongsToMany(\App\Models\Plaza::class);
    }
}