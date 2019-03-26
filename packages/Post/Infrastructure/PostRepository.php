<?php
declare(strict_types=1);

namespace Media\Post\Infrastructure;

use App\Post;
use Media\Post\Domain\PostId;

class PostRepository
{
    /**
     * @param PostId $id
     * @return mixed
     */
    public function find(PostId $id)
    {
        return Post::find($id->getValue());
    }

    /**
     * @param PostId $id
     */
    public function delete(PostId $id): void
    {
        Post::destroy($id->getValue());
    }

    /**
     * @param PostId $id
     * @param string $title
     * @param string $content
     * @param int $user_id
     */
    public function save(PostId $id, string $title, string $content, int $user_id): void
    {
        Post::updateOrCreate(
            ['id' => $id->getValue()],
            [
                'title' => $title,
                'content' => $content,
                'user_id' => $user_id
            ]
        );
    }
}
