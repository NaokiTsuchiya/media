<?php
declare(strict_types=1);

namespace Media\Post\Application;

use App\Http\Requests\PostRequest;
use Media\Post\Domain\PostId;
use Media\Post\Infrastructure\PostRepository;

class PostUpdateService
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
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function execute(string $post_id, PostRequest $request)
    {

        if ($request->user()->hasPost(new PostId($post_id))) {
            $this->postRepository->save(
                new PostId($post_id),
                $request->input('title'),
                $request->input('content'),
                $request->user()->id
            );
        }

        return redirect('/home');
    }
}
