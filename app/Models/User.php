<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }

    public function finReceitas(): HasMany {
        return $this->hasMany(FinReceita::class);
    }

    public function finEntradas()
    {
        return $this->hasMany(FinEntrada::class);
    }

    public function  finSaidas()
    {
        return $this->hasMany(FinSaida::class);
    }

    public function finInvestimentos()
    {
        return $this->hasMany(FinInvestimento::class);
    }

    public function finCartaos() {
        return $this->hasMany(FinCartao::class);
    }
}
