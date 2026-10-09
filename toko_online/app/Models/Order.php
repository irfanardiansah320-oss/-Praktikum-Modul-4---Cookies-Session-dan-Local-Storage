<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $casts = ['tanggal_order' => 'datetime'];
}