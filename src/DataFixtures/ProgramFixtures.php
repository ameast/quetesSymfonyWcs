<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    const PROGRAMS = [
            [
                'title' => 'Stranger Things',
                'synopsis' => 'Un groupe d\'enfants affronte des forces surnaturelles dans une petite ville',
                'category' => 'Fantastique',
            ],
            [
                'title' => 'Game of Thrones',
                'synopsis' => 'Intrigues, batailles et luttes de pouvoir dans les Sept Royaumes',
                'category' => 'Fantastique',
            ],
            [
                'title' => 'Breaking Bad',
                'synopsis' => 'Un professeur de chimie devient un redoutable trafiquant de drogue',
                'category' => 'Aventure',
            ],
            [
                'title' => 'Friends',
                'synopsis' => 'Un groupe d\'amis vit des situations comiques à New York',
                'category' => 'Aventure',
            ],
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as  $key=> $sub_program) {
            $program = new Program();
            $program->setTitle($sub_program['title']);
            $program->setSynopsis($sub_program['synopsis']);
            $program->setCategory($this->getReference('category_' . $sub_program['category']));
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
