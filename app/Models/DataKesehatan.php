<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKesehatan extends Model
{
    use HasFactory;

    protected $table = 'data_kesehatans';

    protected $fillable = [
        'user_id',
        'tinggi_badan',
        'berat_badan',
        'alergi',
        'gaya_hidup',
        'preferensi_makanan',
        'anggaran_makan',
        'tanggal_input',
    ];
}   
