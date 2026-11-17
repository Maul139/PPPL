<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuKantin extends Model
{
    use HasFactory;

    protected $table = 'menu_kantins';

    protected $fillable = [
        'nama_menu',
        'kategori',
        'kalori',
        'harga',
        'deskripsi',
    ];
}
