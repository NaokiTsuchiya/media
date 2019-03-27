<?php
declare(strict_types=1);

namespace Media\Post\Domain;

use Ulid\Ulid;

class PostId
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param string|null $value
     */
    public function __construct(string $value = null)
    {
        $this->value = $value ?? (string)Ulid::generate(true);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getValue();
    }
}
