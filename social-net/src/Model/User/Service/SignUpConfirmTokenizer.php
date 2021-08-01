<?php

declare(strict_types=1);

namespace App\Model\User\Service;

use Ramsey\Uuid\Uuid;

/**
 * Class SignUpConfirmTokenizer
 * @package App\Model\User\Service
 */
class SignUpConfirmTokenizer
{
    /**
     * @return string
     */
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
