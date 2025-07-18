<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['total', 'user_id'];

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
