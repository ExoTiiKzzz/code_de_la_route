<?php

namespace App\DataFixtures;

use App\Entity\Training;
use App\Entity\TrainingType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

class AppFixtures extends Fixture
{
    private array $trainingTypes;

    public function __construct()
    {
        $this->trainingTypes = [];
    }


    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $this->loadTrainingTypes($manager);
        $this->loadTrainings($manager);
        $manager->flush();
    }

    private function loadTrainingTypes(ObjectManager $manager): void
    {
        $trainingTypes = [
            ['name' => 'Examen blanc', 'color' => 'FF5733'],
            ['name' => 'Questions aléatoires', 'color' => '33FF57'],
        ];

        foreach ($trainingTypes as $trainingType) {
            $entity = new TrainingType();
            $entity->setName($trainingType['name']);
            $entity->setColor($trainingType['color']);
            $manager->persist($entity);
            $this->trainingTypes[] = $entity;
        }
    }

    /**
     * @throws Exception
     */
    private function loadTrainings(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $entity = new Training();
            $entity->setScore(random_int(0, 40));
            $entity->setCreatedAt(new \DateTimeImmutable());
            $entity->setType($this->trainingTypes[array_rand($this->trainingTypes)]);
            $manager->persist($entity);
        }
    }
}
