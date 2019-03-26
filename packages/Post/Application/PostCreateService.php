<?php
declare(strict_types=1);

namespace Media\Post\Application;

use App\Http\Requests\PostRequest;
use Media\Post\Domain\PostId;
use Media\Post\Infrastructure\PostRepository;

class PostCreateService
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
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function execute(PostRequest $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');
        $user_id = $request->user()->id;

        $this->postRepository->save(
            new PostId(),
            $title,
            $content,
            $user_id
        );

        return redirect('/home');
    }
}
