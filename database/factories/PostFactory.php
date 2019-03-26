<?php

use App\Post;

$factory->define(Post::class, function () {
    return [
        'id' => (new \Media\Post\Domain\PostId())->getValue(),
        'title' => 'test',
        'content' => 'this is test post.'
    ];
});
