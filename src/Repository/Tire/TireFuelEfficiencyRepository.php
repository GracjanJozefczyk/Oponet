<?php

namespace App\Repository\Tire;

use App\Entity\Tire\TireFuelEfficiency;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TireFuelEfficiency|null find($id, $lockMode = null, $lockVersion = null)
 * @method TireFuelEfficiency|null findOneBy(array $criteria, array $orderBy = null)
 * @method TireFuelEfficiency[]    findAll()
 * @method TireFuelEfficiency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TireFuelEfficiencyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TireFuelEfficiency::class);
    }

    // /**
    //  * @return TireFuelEfficiency[] Returns an array of TireFuelEfficiency objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TireFuelEfficiency
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findAllAndSort()
    {
        return $this->findBy(array(), array('fuelEfficiency' => 'ASC'));
    }
}
