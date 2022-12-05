<?php

namespace App\DataFixtures;

use App\Entity\Game;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $game = new Game();
        $game->setTitle('7 Wonders');

        $manager->flush();
    }
}
