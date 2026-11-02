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
    // Accessor untuk menghitung Nilai IMT
    public function getImtAttribute()
    {
        if (!$this->tinggi_badan || !$this->berat_badan) return 0;
        $tinggiMeter = $this->tinggi_badan / 100;
        return round($this->berat_badan / ($tinggiMeter * $tinggiMeter), 1);
    }

    // Accessor untuk menentukan Status Gizi
    public function getStatusGiziAttribute()
    {
        $imt = $this->imt;
        if ($imt < 18.5) return 'Kurus';
        if ($imt <= 24.9) return 'Normal';
        if ($imt <= 29.9) return 'Gemuk';
        return 'Obesitas';
    }
}
