<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class)->withPivot('stock');
    }

    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class);
    }
}
