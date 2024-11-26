<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Mug;

/**
 * User Model
 * 
 * Represents a user in the system with authentication capabilities
 * Users can have one of three roles: admin, merchant, or regular user
 */
class User extends Authenticatable
{
    // Include traits for API tokens, factory pattern, and notifications functionality
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * These fields can be filled using create() or update() methods
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden from array/JSON representations.
     * Ensures sensitive data isn't exposed when model is converted to array/JSON
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to specific types.
     * Automatically converts these fields to the specified type when accessed
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Check if the user has admin role
     * Used for authorization checks throughout the application
     * 
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user has merchant role
     * Used for authorization checks throughout the application
     * 
     * @return bool
     */
    public function isMerchant(): bool
    {
        return $this->role === 'merchant';
    }

    /**
     * Define relationship with Mug model
     * One user (merchant) can have many mugs
     * This establishes the one-to-many relationship between users and mugs
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mugs(): HasMany
    {
        return $this->hasMany(Mug::class);
    }
}
