<?php
declare(strict_types=1);

namespace Media\Post\Application;

use App\Post;
use App\User;
use Media\Post\Domain\PostId;

class PostShowService
{
    /**
     * @param int $user_id
     * @param string $post_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function execute(int $user_id, string $post_id)
    {
        $user = User::find($user_id);
        $post = Post::find((new PostId($post_id))->getValue());

        return view('post.show', compact('user', 'post'));
    }
}
