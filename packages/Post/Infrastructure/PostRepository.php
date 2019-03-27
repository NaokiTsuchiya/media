<?php
declare(strict_types=1);

namespace Media\Post\Infrastructure;

use App\Post;
use Illuminate\Support\Facades\DB;
use Media\Post\Domain\Post as DomainPost;
use Media\Post\Domain\PostId;

class PostRepository
{
    /**
     * @param PostId $id
     * @return mixed
     */
    public function find(PostId $id)
    {
        $post = DB::table('posts')
            ->select('id', 'title', 'content', 'user_id', 'created_at', 'updated_at')
            ->find($id->getValue());

        return new DomainPost(
            new PostId($post->id),
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
