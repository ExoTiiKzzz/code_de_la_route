<?php

namespace App\Repository;

use App\Entity\TrainingType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TrainingType>
 *
 * @method TrainingType|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrainingType|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrainingType[]    findAll()
 * @method TrainingType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainingTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrainingType::class);
    }

    public function save(TrainingType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TrainingType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
