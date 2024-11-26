<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItem
 * 
 * Represents an individual item within an order
 * 
 * @package App\Models
 */
class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'mug_id',    // ID of the mug being ordered
        'quantity',  // Number of mugs ordered
        'price'      // Price of the mug at time of order
    ];

    /**
     * Get the mug associated with this order item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mug()
    {
        return $this->belongsTo(Mug::class);
    }
} 