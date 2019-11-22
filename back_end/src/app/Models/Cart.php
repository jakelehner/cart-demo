<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $with = [
        'items',
    ];
    
    protected $dates = [];

    protected $fillable = [
        'user_fingerprint',
    ];

    protected $hidden = [];

    protected $casts = [];
    
    protected $dispatchesEvents = [];

    /* RELATIONSHIPS */

    public function items()
    {
        return $this->belongsToMany(
            Product::class,
            'cart_items',
            'cart_id',
            'product_id'
        )->withPivot('quantity');
    }

    /* ACCESSORS & MUTATORS */
}
