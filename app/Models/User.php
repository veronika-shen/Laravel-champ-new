<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function teammateCommand(): BelongsToMany
    {
        return $this->belongsToMany(Command::class, 'teammates', 'user_id');
    }

    public function ownerCommands(): HasMany
    {
        return $this->hasMany(Command::class, 'owner_id');
    }
}
