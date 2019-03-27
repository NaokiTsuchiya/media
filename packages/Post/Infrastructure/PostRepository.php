<?php
declare(strict_types=1);

namespace Media\Post\Infrastructure;

use App\Post as EloquentPost;
use Media\Post\Domain\Post;
use Media\Post\Domain\PostId;
use Media\Post\Domain\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @param PostId $id
     * @return Post
     */
    public function find(PostId $id): Post
    {
        $post = EloquentPost::find($id->getValue());

        return new Post(
            $id,
            $post->title,
            $post->content,
            $post->user_id,
            $post->created_at,
            $post->updated_at
        );
    }

    /**
     * @param PostId $id
     */
    public function delete(PostId $id): void
    {
        EloquentPost::destroy($id->getValue());
    }

    /**
     * @param Post $post
     */
    public function save(Post $post): void
    {
        EloquentPost::updateOrCreate(
            ['id' => $post->getId()],
            [
                'title' => $post->getTitle(),
                'content' => $post->getContent(),
                'user_id' => $post->getUserId()
            ]
        );
    }
}
