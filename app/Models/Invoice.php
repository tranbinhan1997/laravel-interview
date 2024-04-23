<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer',
        'total',
        'user_id'
    ];

    public function invoiceItems()
    {
        return $this->hasMany('App\Models\InvoiceItem');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
}
