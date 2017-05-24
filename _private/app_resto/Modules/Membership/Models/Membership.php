<?php

namespace Modules\Membership\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mod_membership';

    protected $fillable = ['google_id', 'facebook_id', 'twitter_id', 'nama', 'image', 'email', 'telepon', 'alamat', 'url', 'status', 'created_by', 'updated_by'];
}
