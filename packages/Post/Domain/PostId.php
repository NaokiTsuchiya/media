<?php
declare(strict_types=1);

namespace Media\Post\Domain;

use Ulid\Ulid;

class PostId
{

    private $value;

    /**
     * @param string|null $value
     */
    public function __construct(string $value = null)
    {
        $this->value = $value ?? Ulid::generate(true);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return (string)$this->value;
    }

    public function __toString()
    {
        return $this->getValue();
    }
}
