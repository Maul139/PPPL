<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKesehatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ttl',
        'umur',
        'tinggi_badan',
        'berat_badan',
        'alergi',
        'riwayat_penyakit',
        'catatan_gizi',
        'rekomendasi_menu',
        'gaya_hidup',
        'preferensi_makanan',
        'anggaran_makan',
        'tanggal_input',
    ];

    public function getImtAttribute()
    {
        if ($this->tinggi_badan > 0) {
            $tinggiMeter = $this->tinggi_badan / 100;
            return round($this->berat_badan / ($tinggiMeter * $tinggiMeter), 1);
        }
        return 0;
    }

    public function getStatusGiziAttribute()
    {
        $imt = $this->imt;
        if ($imt < 18.5) return 'Kurus';
        if ($imt <= 24.9) return 'Normal';
        if ($imt <= 29.9) return 'Gemuk';
        return 'Obesitas';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
