<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use SoftDeletes;

    protected $table = 'agendas';
    public $timestamps = true;

    protected $fillable = [
        'title',
        'description',
        'date',
        'hour',
        'participants',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'date' => 'datetime',
        'hour' => 'string',
        'participants' => 'array'
    ];
}
