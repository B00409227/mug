<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 * Class Mug
 * 
 * Represents a mug product in the system
 * 
 * @package App\Models
 */
class Mug extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',        // The name of the mug
        'description', // Description of the mug
        'price',       // Price of the mug
        'stock',       // Available quantity in stock
        'image',       // Path/URL to the mug's image
        'user_id',     // ID of the user who owns/created this mug
        'is_active'    // Flag indicating if the mug is active/available
    ];

    /**
     * Get the user that owns the mug.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 