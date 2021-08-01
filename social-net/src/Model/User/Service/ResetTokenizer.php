<?php

declare(strict_types=1);

namespace App\Model\User\Service;

use App\Model\User\Entity\User\ResetToken;
use Ramsey\Uuid\Uuid;

/**
 * Class ResetTokenizer
 * @package App\Model\User\Service
 */
class ResetTokenizer
{
    /**
     * @var \DateInterval
     */
    private $interval;

    /**
     * ResetTokenizer constructor.
     * @param \DateInterval $interval
     */
    public function __construct(\DateInterval $interval)
    {
        $this->interval = $interval;
    }

    /**
     * @return ResetToken
     * @throws \Exception
     */
    public function generate(): ResetToken
    {
        return new ResetToken(
            Uuid::uuid4()->toString(),
            (new \DateTimeImmutable())->add($this->interval)
        );
    }
}
