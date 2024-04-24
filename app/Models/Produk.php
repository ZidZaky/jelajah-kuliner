<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
    // Specify the columns that are mass assignable
    protected $fillable = [
        'namaProduk', 'desc', 'harga', 'stok', 'jenisProduk', 'fotoProduk', 'idPKL'
    ];

    protected $nullable = [
        'fotoProduk'
    ];
}
