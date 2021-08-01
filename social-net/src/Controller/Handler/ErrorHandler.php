<?php

declare(strict_types=1);

namespace App\Controller\Handler;

use Psr\Log\LoggerInterface;

/**
 * Хэндлер для логирования ошибок
 *
 * Class ErrorHandler
 * @package App\Controller\Handler
 */
class ErrorHandler
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Ошибки кладем в лог
     * @param \DomainException $e
     */
    public function handle(\DomainException $e): void
    {
        $this->logger->warning($e->getMessage(), ['exception' => $e]);
    }
}
