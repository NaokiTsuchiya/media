<?php
declare(strict_types=1);

namespace Media\Post\Application;

use App\Http\Requests\PostRequest;
use Media\Post\Domain\Post;
use Media\Post\Domain\PostId;
use Media\Post\Domain\PostRepositoryInterface;

class PostCreateService
{

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function execute(PostRequest $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');
        $user_id = $request->user()->id;
        $post = new Post(
            new PostId(),
            $title,
            $content,
            $user_id
        );

        $this->postRepository->save($post);

        return redirect('/home');
    }
}
