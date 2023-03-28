<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'r_users_roles',
        'r_users_estados',
        'image_path'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles()
    {
        return $this->belongsTo(Roles::class, 'r_users_roles');
    }
    public function elRol()
    {
        return $this->belongsTo(Roles::class, 'r_users_roles')
            ->distinct();
    }

    public function permisos()
    {
        return $this->roles->permisos();
    }

    public function elPermiso()
    {
        return $this->roles->permisos()->distinct();
    }
    public function estado()
    {
        return $this->belongsTo(Estados::class, 'r_users_estados');
    }
    public function elEstado()
    {
        return $this->belongsTo(Estados::class, 'r_users_estados')->distinct();
    }
}
