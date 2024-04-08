<?php

use App\Entity\Training;
use App\Entity\TrainingType;
use App\Repository\TrainingRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\NotSupported;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TrainingRepositoryTest extends KernelTestCase
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

        $trainingType = $this->entityManager->getRepository(TrainingType::class)->findOneBy([]);

        $training = new Training();
        $training->setType($trainingType);
        $training->setCreatedAt(new \DateTimeImmutable());
        $training->setScore(25);

        $this->entityManager->getRepository(Training::class)->save($training, false);

        $this->assertNull($training->getId());

        $this->entityManager->flush();

        $this->assertNotNull($training->getId());
    }

    public function testRemove(): void
    {
        $training = $this->entityManager->getRepository(Training::class)->findOneBy([]);

        $this->entityManager->getRepository(Training::class)->remove($training, false);

        $this->assertNotNull($training->getId());

        $this->entityManager->flush();

        $this->assertNull($training->getId());
    }
}
