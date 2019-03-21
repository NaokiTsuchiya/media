<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Media\Post\Domain\PostId;

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
            $model->id = (new PostId())->getValue();
        });

        static::retrieved(function ($model) {
            $model->id = (new PostId($model->id))->getValue();
        });

    }

}
