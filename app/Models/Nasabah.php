<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap', 'email', 'no_telp', 'alamat'
    ];

    public function suamiIstri(){
        return $this->hasOne(Suami_istri::class, 'nasabah_id', 'id')->withDefault();
    }

    public function emergencyCall(){
        return $this->hasMany(Emergency_contact::class, 'nasabah_id', 'id');
    }
}
