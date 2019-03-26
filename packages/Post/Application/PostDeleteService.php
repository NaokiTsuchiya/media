<?php
declare(strict_types=1);

namespace Media\Post\Application;

use App\Post;
use Illuminate\Support\Facades\Auth;
use Media\Post\Domain\PostId;

class PostDeleteService
{
    /**
     * @param string $post_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function execute(string $post_id)
    {
        $post_id = (new PostId($post_id))->getValue();

        if (Post::find($post_id)->owner(Auth::id())) {
            Post::destroy($post_id);
        }

        return redirect('/home');
    }
}
