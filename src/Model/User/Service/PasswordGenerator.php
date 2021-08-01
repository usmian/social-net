<?php

declare(strict_types=1);

namespace App\Model\User\Service;

use Ramsey\Uuid\Uuid;

/**
 * Class PasswordGenerator
 * @package App\Model\User\Service
 */
class PasswordGenerator
{
    /**
     * @return string
     */
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
