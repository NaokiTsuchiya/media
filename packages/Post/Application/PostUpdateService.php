<?php
declare(strict_types=1);

namespace Media\Post\Application;

use App\Http\Requests\PostRequest;
use App\Post;
use Media\Post\Domain\PostId;

class PostUpdateService
{
    /**
     * @param string $post_id
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function execute(string $post_id, PostRequest $request)
    {
        $post_id = (new PostId($post_id))->getValue();

        if ($request->user()->hasPost($post_id)) {
            $post = Post::find($post_id);
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->save();
        }

        return redirect('/home');
    }
}
