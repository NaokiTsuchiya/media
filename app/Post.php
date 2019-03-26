<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Media\Post\Domain\PostId;

class Post extends Model
{

    public $incrementing = false;
    protected $fillable = [
        'id',
        'title',
        'content',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();

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
        return $this->user_id === $user_id;
    }

}
