<?php

namespace Modules\PustakaGambar\Models;

use Illuminate\Database\Eloquent\Model;

class PustakaGambar extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mod_pustakagambar';

    protected $fillable = ['copyright', 'keterangan', 'owner_id', 'kategori', 'image', 'url', 'status', 'created_by', 'updated_by'];
}
