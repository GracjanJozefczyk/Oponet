<?php

namespace App\Repository\Tire;

use App\Entity\Tire\TireHeight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TireHeight|null find($id, $lockMode = null, $lockVersion = null)
 * @method TireHeight|null findOneBy(array $criteria, array $orderBy = null)
 * @method TireHeight[]    findAll()
 * @method TireHeight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TireHeightRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TireHeight::class);
    }

    // /**
    //  * @return TireHeight[] Returns an array of TireHeight objects
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
    public function findOneBySomeField($value): ?TireHeight
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
