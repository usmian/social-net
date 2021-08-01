<?php

namespace App\DataFixtures;

use App\Model\User\Entity\User\Email;
use App\Model\User\Entity\User\Name;
use App\Model\User\Entity\User\Role;
use App\Model\User\Entity\User\User;
use App\Model\User\Entity\User\Id;
use App\Model\User\Service\PasswordHasher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class UserFixture
 * @package App\DataFixtures
 */
class UserFixture extends Fixture
{
    public const REFERENCE_ADMIN = 'user_user_admin';
    public const REFERENCE_USER = 'user_user_user';

    /**
     * @var PasswordHasher
     */
    private $hasher;

    /**
     * UserFixture constructor.
     * @param PasswordHasher $hasher
     */
    public function __construct(PasswordHasher $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $hash = $this->hasher->hash('password');

        $network = $this->createSignedUpByNetwork(
            new Name('David', 'Black'),
            'facebook',
            '1000000'
        );
        $manager->persist($network);

        $requested = $this->createSignUpRequestedByEmail(
            new Name('John', 'Doe'),
            new Email('requested@app.test'),
            $hash
        );
        $manager->persist($requested);

        $confirmed = $this->createSignUpConfirmedByEmail(
            new Name('Brad', 'Pitt'),
            new Email('user@app.test'),
            $hash
        );
        $manager->persist($confirmed);
        $this->setReference(self::REFERENCE_USER, $confirmed);

        $admin = $this->createAdminByEmail(
            new Name('James', 'Bond'),
            new Email('admin@app.test'),
            $hash
        );
        $manager->persist($admin);
        $this->setReference(self::REFERENCE_ADMIN, $admin);

        $manager->flush();
    }

    /**
     * @param Name $name
     * @param Email $email
     * @param string $hash
     * @return User
     */
    private function createAdminByEmail(Name $name, Email $email, string $hash): User
    {
        $user = $this->createSignUpConfirmedByEmail($name, $email, $hash);
        $user->changeRole(Role::admin());
        return $user;
    }

    /**
     * @param Name $name
     * @param Email $email
     * @param string $hash
     * @return User
     */
    private function createSignUpConfirmedByEmail(Name $name, Email $email, string $hash): User
    {
        $user = $this->createSignUpRequestedByEmail($name, $email, $hash);
        $user->confirmSignUp();
        return $user;
    }

    /**
     * @param Name $name
     * @param Email $email
     * @param string $hash
     * @return User
     * @throws \Exception
     */
    private function createSignUpRequestedByEmail(Name $name, Email $email, string $hash): User
    {
        return User::signUpByEmail(
            Id::next(),
            new \DateTimeImmutable(),
            $name,
            $email,
            $hash,
            'token'
        );
    }

    /**
     * @param Name $name
     * @param string $network
     * @param string $identity
     * @return User
     * @throws \Exception
     */
    private function createSignedUpByNetwork(Name $name, string $network, string $identity): User
    {
        return User::signUpByNetwork(
            Id::next(),
            new \DateTimeImmutable(),
            $name,
            $network,
            $identity
        );
    }
}
