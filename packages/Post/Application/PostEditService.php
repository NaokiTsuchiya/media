<?php
declare(strict_types=1);

namespace Media\Post\Application;

use App\Post;
use Illuminate\Support\Facades\Auth;
use Media\Post\Domain\PostId;

class PostEditService
{
    /**
     * @param string $post_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function execute(string $post_id)
    {
        $post = Post::find((new PostId($post_id))->getValue());

        if ($post->owner(Auth::id())) {
            return view('post.edit', compact('post'));
        }

        return redirect('/home');
    }
}
