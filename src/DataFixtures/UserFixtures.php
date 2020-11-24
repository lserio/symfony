<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $password_encoder)
    {
        $this->password_encoder = $password_encoder;
    }

    public function load(ObjectManager $manager)
    {
        foreach($this->getUserData() as [$email, $password, $roles])
        {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($this->password_encoder->encodePassword($user,$password));
            $user->setRoles($roles);

            $manager->persist($user);
        }

        $manager->flush();
    }

    private function getUserData(): array
    {
        return [

            ['luca.serio.dev@gmail.com', 'password', ['ROLE_USER']],
        ];
    }
}
