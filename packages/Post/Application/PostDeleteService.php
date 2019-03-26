<?php
declare(strict_types=1);

namespace Media\Post\Application;

use App\Post;
use Illuminate\Support\Facades\Auth;
use Media\Post\Domain\PostId;
use Media\Post\Infrastructure\PostRepository;

class PostDeleteService
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function execute(string $post_id)
    {
        $post_id = new PostId($post_id);
        $post = $this->postRepository->find($post_id);

        if ($post->owner(Auth::id())) {
            $this->postRepository->delete($post_id);
        }

        return redirect('/home');
    }
}
