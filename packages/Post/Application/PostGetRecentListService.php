<?php
declare(strict_types=1);

namespace Media\Post\Application;


use Media\Post\Domain\PostRepositoryInterface;

class PostGetRecentListService
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;
    private const PAGINATION_SIZE = 10;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function execute()
    {
        $posts = $this->postRepository->getRecentPostList(static::PAGINATION_SIZE);
        return view('post.index', compact('posts'));
    }
}
