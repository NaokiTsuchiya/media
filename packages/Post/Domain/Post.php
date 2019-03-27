<?php
declare(strict_types=1);

namespace Media\Post\Domain;

use App\User;

class Post
{
    /**
     * @var PostId
     */
    public $id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $content;
    /**
     * @var int
     */
    public $user_id;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $updated_at;

    /**
     * @param PostId $id
     * @param string $title
     * @param string $content
     * @param int $user_id
     * @param string $created_at
     * @param string $updated_at
     */
    public function __construct(
        PostId $id,
        string $title,
        string $content,
        int $user_id,
        string $created_at,
        string $updated_at
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function owned(User $user): bool
    {
        return $user->id === $this->user_id;
    }
}
