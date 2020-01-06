<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    protected $table = 'contacts';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'phones',
        'email',
        'name'
    ];
    protected $casts = [
        'user_id' => 'integer',
        'phones' => 'array',
        'email' => 'string',
        'name' => 'string'
    ];
}
