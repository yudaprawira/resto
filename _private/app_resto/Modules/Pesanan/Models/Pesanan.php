<?php

namespace Modules\Pesanan\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mod_pesanan';

    protected $fillable = ['invoice', 'url', 'status', 'created_by', 'updated_by'];
}
