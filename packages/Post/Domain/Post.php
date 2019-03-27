<?php
declare(strict_types=1);

namespace Media\Post\Domain;

use App\User;
use Carbon\Carbon;

class Post
{
    /**
     * @var PostId
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $content;
    /**
     * @var int
     */
    private $user_id;
    /**
     * @var Carbon
     */
    private $created_at;
    /**
     * @var Carbon
     */
    private $updated_at;

    /**
     * @param PostId $id
     * @param string $title
     * @param string $content
     * @param int $user_id
     * @param Carbon $created_at
     * @param Carbon $updated_at
     */
    public function __construct(
        PostId $id,
        string $title,
        string $content,
        int $user_id,
        Carbon $created_at = null,
        Carbon $updated_at = null
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

    /**
     * @return PostId
     */
    public function getId(): PostId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }
}
