<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    // Mutator agar path logo selalu diawali 'sekolah/' jika belum ada
    public function setLogoAttribute($value)
    {
        if ($value && !str_starts_with($value, 'sekolah/')) {
            $this->attributes['logo'] = 'sekolah/' . ltrim($value, '/');
        } else {
            $this->attributes['logo'] = $value;
        }
    }

    protected $fillable = [
        'nama',
        'tahun_masuk',
        'tahun_lulus',
        'jurusan',
        'deskripsi',
        'logo',
        'color',
        'aktif',
        'pernah_menjadi_apa',
    ];
}
