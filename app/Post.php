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

        static::updating(function ($model) {
            $model->id = (new PostId($model->id))->getValue();
        });

        static::retrieved(function ($model) {
            $model->id = (new PostId($model->id))->getValue();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param int $user_id
     * @return bool
     */
    public function owner(int $user_id): bool
    {
        return $this->user->id === $user_id;
    }

}
