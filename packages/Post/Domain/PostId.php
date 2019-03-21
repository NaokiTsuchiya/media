<?php
declare(strict_types=1);

namespace Media\Post\Domain;

use Ramsey\Uuid\Uuid;

class PostId
{

    private $value;

    /**
     * @param string $value
     */
    public function __construct(string $value = null)
    {
        $this->value = $value ?? $this->createId();
    }

    /**
     * @return string
     */
    private function createId(): string
    {
        try {
            return Uuid::uuid1()->getHex() . bin2hex(random_bytes(2));
        } catch (\Exception $e) {
            throw new \RuntimeException('Can not create postId');
        }
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        if (ctype_xdigit($this->value)) {
            return hex2bin($this->value);
        }

        return bin2hex($this->value);
    }

}
