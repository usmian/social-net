<?php

declare(strict_types=1);

namespace App\Model\User\Service;

use Ramsey\Uuid\Uuid;

/**
 * Class NewEmailConfirmTokenizer
 * @package App\Model\User\Service
 */
class NewEmailConfirmTokenizer
{
    /**
     * @return string
     */
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
