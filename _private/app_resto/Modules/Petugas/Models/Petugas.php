<?php

namespace Modules\Petugas\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    protected $fillable = ['username', 'email', 'image', 'pemilik_id', 'level_id', 'url', 'status', 'hash', 'password', 'created_by', 'updated_by'];

    function level ()
    {
        return $this->hasOne('\App\Models\System\Level', 'id', 'level_id');
    }
}
