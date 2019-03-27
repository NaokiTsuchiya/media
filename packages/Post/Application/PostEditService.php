<?php
declare(strict_types=1);

namespace Media\Post\Application;

use App\Post;
use Illuminate\Support\Facades\Auth;
use Media\Post\Domain\PostId;
use Media\Post\Infrastructure\PostRepository;

class PostEditService
{

    /**
     * @var PostRepository
     */
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param string $post_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function execute(string $post_id)
    {
        $post = $this->postRepository->find(new PostId($post_id));

        if ($post->owned(Auth::user())) {
            return view('post.edit', compact('post'));
        }

        return redirect('/home');
    }
}
