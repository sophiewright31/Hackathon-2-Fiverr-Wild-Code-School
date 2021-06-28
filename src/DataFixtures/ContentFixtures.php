<?php

namespace App\DataFixtures;

use App\Entity\Content;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContentFixtures extends Fixture
{
    const MESSAGES = [
        'Hi there.',
        'How are you today ?',
        'I haven\'t seen you around here before. Have you worked here long?',
        'Well, I better get back to my desk.',
        'I can\'t believe all of this cold weather. Hopefully Spring will come soon.',
        'My divorce will finally come through by then!',
        'Hey, you look like you could really use a coffee.',
        'Say, did you happen to catch the game last night?',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::MESSAGES as $key => $message) {
            $content = new Content();
            $content->setMessage($message);

            $manager->persist($content);
        }

        $manager->flush();
    }
}
