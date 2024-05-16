<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orders extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'clients_id',
        'order_date',
        'status_id',
        'product_id',
        'order_price',
        'description',
    ];

    /**
     * Get the client associated with the order.
     *
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'clients_id');
    }

    /**
     * Get the status associated with the order.
     *
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
