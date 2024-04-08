<?php

use App\Entity\TrainingType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\NotSupported;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TrainingTypeRepositoryTest extends KernelTestCase
{
    private EntityManager $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * @throws NotSupported
     */
    public function testSave(): void
    {

        $trainingType = new TrainingType();
        $trainingType->setName('Test');
        $trainingType->setColor('FFFFFF');

        $this->entityManager->getRepository(TrainingType::class)->save($trainingType, false);

        $this->assertNull($trainingType->getId());

        $this->entityManager->flush();

        $this->assertNotNull($trainingType->getId());
    }

    public function testRemove(): void
    {
        $trainingType = $this->entityManager->getRepository(TrainingType::class)->findOneBy([]);

        $this->entityManager->getRepository(TrainingType::class)->remove($trainingType, false);

        $this->assertNotNull($trainingType->getId());

        $this->entityManager->flush();

        $this->assertNull($trainingType->getId());
    }
}
