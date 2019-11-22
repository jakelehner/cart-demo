<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $dates = [];

    protected $fillable = [
        'sku',
        'display_name',
        'unit_cost',
    ];

    protected $hidden = [];

    protected $casts = [];
    
    protected $dispatchesEvents = [];

    /* RELATIONSHIPS */

    public function carts()
    {
        return $this->belongsToMany(
            Cart::class,
            'cart_items',
            'product_id',
            'cart_id'
        );
    }

    /* ACCESSORS & MUTATORS */
}
