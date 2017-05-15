<?php

namespace Modules\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mod_menu';

    protected $fillable = ['nama', 'foto_utama', 'foto_info', 'foto', 'url', 'kategori', 'halal', 'harga', 'deskripsi', 'status', 'created_by', 'updated_by'];

    function kategori()
    {
        return $this->hasOne('\Modules\Kategori\Models\Kategori', 'id', 'kategori');
    }
}
