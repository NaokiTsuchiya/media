<?php
declare(strict_types=1);

namespace Media\Post\Domain;


interface PostRepositoryInterface
{
    /**
     * @param PostId $id
     * @return Post
     */
    public function find(PostId $id): Post;

    /**
     * @param Post $post
     */
    public function save(Post $post): void;

    /**
     * @param PostId $id
     */
    public function delete(PostId $id): void;

    /**
     * @param int $size
     * @return mixed
     */
    public function getRecentPostList(int $size);
}
