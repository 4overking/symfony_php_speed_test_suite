<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends BaseFixture
{
    public const ADMIN_EMAIL_REFERENCE = 'admin@test.com';
    public const EXECUTOR1_EMAIL_REFERENCE = 'executor1@test.com';
    public const EXECUTOR2_EMAIL_REFERENCE = 'executor2@test.com';

    public function loadData(ObjectManager $manager)
    {
        foreach (self::getUserEmails() as $email) {
            $user = new User();
            $user
                ->setEmail($email)
                ->setFirstName($this->faker->firstName)
                ->setLastName($this->faker->lastName)
            ;
            $manager->persist($user);

            $this->addReference($email, $user);
        }

        $manager->flush();
    }

    public static function getUserEmails(): array
    {
        return [
            self::ADMIN_EMAIL_REFERENCE,
            self::EXECUTOR1_EMAIL_REFERENCE,
            self::EXECUTOR2_EMAIL_REFERENCE,
        ];
    }
}
