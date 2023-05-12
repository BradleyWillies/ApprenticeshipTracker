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

    public function manager(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Manager::class);
    }

    public function apprentice(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Apprentice::class);
    }

    /**
     * function to check if the user is a manager
     *
     * @return bool
     */
    public function isManager():bool
    {
        return $this->manager()->exists();
    }

    /**
     * function to check if the user is an apprentice
     *
     * @return bool
     */
    public function isApprentice():bool
    {
        return $this->apprentice()->exists();
    }
}
