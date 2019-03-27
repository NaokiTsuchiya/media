<?php
declare(strict_types=1);

namespace Media\Post\Domain;


interface PostRepositoryInterface
{
    /**
     * @param PostId $postId
     * @return Post
     */
    public function find(PostId $postId): Post;

    /**
     * @param Post $post
     */
    public function save(Post $post): void;

    /**
     * @param PostId $postId
     */
    public function delete(PostId $postId): void;
}
