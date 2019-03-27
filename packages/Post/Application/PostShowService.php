<?php
declare(strict_types=1);

namespace Media\Post\Application;

use App\User;
use Media\Post\Application\ViewModels\PostViewModel;
use Media\Post\Domain\PostId;
use Media\Post\Infrastructure\PostRepository;

class PostShowService
{

    private $postRepository;

    /**
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param int $user_id
     * @param string $post_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function execute(int $user_id, string $post_id)
    {
        $user = User::find($user_id);
        $post = $this->postRepository->find(new PostId($post_id));
        $post = new PostViewModel(
            $post->getId()->getValue(),
            $post->getTitle(),
            $post->getContent(),
            $post->getUserId(),
            $post->getCreatedAt(),
            $post->getUpdatedAt()
        );

        return view('post.show', compact('user', 'post'));
    }
}
