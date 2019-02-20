<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Post extends Model
{

    public $incrementing = false;
    protected $fillable = [
        'title',
        'content'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = hex2bin(Uuid::uuid1()->getHex() . bin2hex(random_bytes(2)));
        });

        static::retrieved(function ($model) {
            $model->id = bin2hex($model->id);
        });

    }

}
