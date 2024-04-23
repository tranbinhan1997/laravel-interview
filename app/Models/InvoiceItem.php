<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'product_name',
        'unit',
        'price',
        'quantity',
        'amount',
        'invoice_id',
        'product_id'
    ];

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
