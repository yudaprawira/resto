<?php

namespace Modules\Penilaian\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mod_penilaian';

    protected $fillable = ['komentar', 'url', 'status', 'created_by', 'updated_by'];
}
