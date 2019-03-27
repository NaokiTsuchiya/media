<?php
declare(strict_types=1);

namespace Media\Post\Application\ViewModels;

use Carbon\Carbon;

class PostViewModel
{
    /**
     * @var string
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
     * @var Carbon
     */
    public $created_at;
    /**
     * @var Carbon
     */
    public $updated_at;

    /**
     * @param string $id
     * @param string $title
     * @param string $content
     * @param int $user_id
     * @param Carbon $created_at
     * @param Carbon $updated_at
     */
    public function __construct(
        string $id,
        string $title,
        string $content,
        int $user_id,
        Carbon $created_at,
        Carbon $updated_at
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}
