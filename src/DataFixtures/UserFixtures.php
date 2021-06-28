<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const FIRSTNAMES = [
        'Marie',
        'Philippe',
        'Sara',
        'Gui',
        'Matthieu',
        'Soph',
        'Viviane',
        'Dominique',
        'Pakpak',
        'Momo',
        'Jessy',
    ];

    public const LASTNAMES = [
        'Sauvage',
        'Roger',
        'Ajana',
        'Harari',
        'Dejean',
        'Wright',
        'Dupont',
        'Mac Affy',
        'Rajyna',
        'Tunisia',
        'Johnson',
    ];

    public const EMAILS = [
        'Sauvage@gmail.com',
        'Roger@gmail.com',
        'Ajana@gmail.com',
        'Harari@gmail.com',
        'Dejean@gmail.com',
        'Wright@gmail.com',
        'Dupont@gmail.com',
        'MacAffy@gmail.com',
        'Rajyna@gmail.com',
        'Tunisia@gmail.com',
        'Johnson@gmail.com',
    ];

    public const PICTURES = [
        'https://avatars.githubusercontent.com/u/1647758?v=4',
        'https://avatars.githubusercontent.com/u/68536902?v=4',
        'https://avatars.githubusercontent.com/u/77840591?v=4',
        'https://avatars.githubusercontent.com/u/29205777?v=4',
        'https://avatars.githubusercontent.com/u/59830027?v=4',
        'https://avatars.githubusercontent.com/u/78907218?s=60&v=4',
        'https://avatars.githubusercontent.com/u/2752047?v=4',
        'https://avatars.githubusercontent.com/u/2892479?v=4',
        'https://avatars.githubusercontent.com/u/303913?v=4',
        'https://avatars.githubusercontent.com/u/1527944?v=4',
        'https://avatars.githubusercontent.com/u/27324?v=4',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::FIRSTNAMES as $key => $userName) {
            $user = new User();
            $user->setFirstname($userName);
            $user->setLastname(self::LASTNAMES[$key]);
            $user->setMail(self::EMAILS[$key]);
            $user->setPicture(self::PICTURES[$key]);

            $manager->persist($user);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
