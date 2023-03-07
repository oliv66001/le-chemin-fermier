<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class UserFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $passwordHasher, private SluggerInterface $slugger)
    {
    }

    public function load(ObjectManager $manager): void
    {
         $admin = new User();
            $admin->setEmail('admin@demo.fr');
            $admin->setResetToken('admin');
            $admin->setLastname('Admin');
            $admin->setFirstname('Admin');
            $admin->setPhone('0606060606');
            $admin->setRoles(['ROLE_ADMIN']);
            $admin->setPassword($this->passwordHasher->hashPassword($admin, 'admin'));
         $manager->persist($admin);

         $dishesadmin = new User();
            $dishesadmin->setEmail('dishesadmin@demo.fr');
            $dishesadmin->setResetToken('dishesadmin');
            $dishesadmin->setLastname('dishesAdmin');
            $dishesadmin->setFirstname('dishesAdmin');
            $dishesadmin->setPhone('0606060607');
            $dishesadmin->setRoles(['ROLE_DISHES_ADMIN']);
            $dishesadmin->setPassword($this->passwordHasher->hashPassword($dishesadmin, 'dishesadmin'));
         $manager->persist($dishesadmin);

         $faker = \Faker\Factory::create('fr_FR');

         for ($usr =1; $usr <= 5; $usr++) {
            $user = new User();
            $user->setEmail($faker->email);
            $user->setResetToken($faker->sha1);
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setPhone(str_replace(' ', '', $faker->phoneNumber));
            $user->setPassword($this->passwordHasher->hashPassword($user, 'user'));
            $manager->persist($user);
         }

        $manager->flush();
    }
}
