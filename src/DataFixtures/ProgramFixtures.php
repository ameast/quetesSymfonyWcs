<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    const series = [
            [
                'title' => 'Stranger Things',
                'synopsis' => 'Un groupe d\'enfants affronte des forces surnaturelles dans une petite ville',
                'category' => 'category_Fantastique'
            ],
            [
                'title' => 'Game of Thrones',
                'synopsis' => 'Intrigues, batailles et luttes de pouvoir dans les Sept Royaumes',
                'category' => 'category_Fantastique'
            ],
            [
                'title' => 'Breaking Bad',
                'synopsis' => 'Un professeur de chimie devient un redoutable trafiquant de drogue',
                'category' => 'category_Aventure'
            ],
            [
                'title' => 'Friends',
                'synopsis' => 'Un groupe d\'amis vit des situations comiques à New York',
                'category' => 'category_Aventure'
            ],
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::series as $serie) {
            $program = new Program();
            $program->setTitle($serie['title']);
            $program->setSynopsis($serie['synopsis']);
            $program->setCategory($this->getReference($serie['category']));
            $manager->persist($program);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];

    }

}
