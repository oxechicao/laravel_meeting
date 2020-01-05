<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customers';
    protected $primaryKey = 'customer_id';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'name',
        'meeting_preferencies'
    ];
    protected $casts = [
        'user_id' => 'integer',
        'name' => 'string',
        'meeting_preferencies' => 'array'
    ];
}
