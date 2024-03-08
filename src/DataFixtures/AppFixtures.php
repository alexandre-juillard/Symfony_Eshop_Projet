<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = (new User)
            ->setLastName('Juillard')
            ->setFirstName('Alexandre')
            ->setEmail('xelaj@test.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword(
                $this->hasher->hashPassword(new User, 'Test123!')
            )
            ->setEnable(true);


        $manager->persist($user);

        for ($i = 0; $i < 10; $i++) {
            $user = (new User)
                ->setLastName('User')
                ->setFirstName($i)
                ->setEmail("user-$i@test.com")
                ->setPassword(
                    $this->hasher->hashPassword($user, 'Test123!')
                )
                ->setEnable(true);


            $manager->persist($user);
        }

        $manager->flush();
    }
}
