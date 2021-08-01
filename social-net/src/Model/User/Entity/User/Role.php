<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;

use Webmozart\Assert\Assert;

/**
 * Class Role
 * --value object
 * @package App\Model\User\Entity\User
 */
class Role
{
    public const USER = 'ROLE_USER';
    public const ADMIN = 'ROLE_ADMIN';

    /**
     * @var string
     */
    private $name;

    /**
     * Role constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        Assert::oneOf($name, [
            self::USER,
            self::ADMIN,
        ]);

        $this->name = $name;
    }

    /**
     * @return Role
     */
    public static function user(): self
    {
        return new self(self::USER);
    }

    /**
     * @return Role
     */
    public static function admin(): self
    {
        return new self(self::ADMIN);
    }

    /**
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->name === self::USER;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->name === self::ADMIN;
    }

    /**
     * @param self $role
     * @return bool
     */
    public function isEqual(self $role): bool
    {
        return $this->getName() === $role->getName();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
