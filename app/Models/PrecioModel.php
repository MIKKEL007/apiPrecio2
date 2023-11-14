<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecioModel extends Model
{
    use HasFactory;
    protected $table = 'precio';
    protected $fillable = ['nombre', 'tipo', 'precio'];
}
