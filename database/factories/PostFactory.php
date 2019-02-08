<?php

use App\Post;

$factory->define(Post::class, function () {
    return [
        'title' => 'test',
        'content' => 'this is test post.'
    ];
});
