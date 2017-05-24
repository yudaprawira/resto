<?php

namespace Modules\Restoran\Models;

use Illuminate\Database\Eloquent\Model;

class Restoran extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mod_restoran';

    protected $fillable = [
        'nama', 'foto_utama', 'foto', 'url', 'type', 'fasilitas', 'jam_operasional', 'deskripsi',
        'kecamatan', 'kota', 'provinsi', 'kodepos', 'alamat', 'lokasi_lat', 'lokasi_lng', 'kategori',
        'kontak_bbm', 'kontak_telepon', 'kontak_wa', 'kontak_facebook', 'kontak_twitter', 'kontak_instagram', 
        'status', 'created_by', 'updated_by'
    ];

    function menu()
    {
        return $this->hasMany('Modules\Menu\Models\Menu', 'pemilik_id', 'id');
    }
}
