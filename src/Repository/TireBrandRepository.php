<?php

namespace App\Repository;

use App\Entity\TireBrand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TireBrand|null find($id, $lockMode = null, $lockVersion = null)
 * @method TireBrand|null findOneBy(array $criteria, array $orderBy = null)
 * @method TireBrand[]    findAll()
 * @method TireBrand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TireBrandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TireBrand::class);
    }

    // /**
    //  * @return TireBrand[] Returns an array of TireBrand objects
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
    public function findOneBySomeField($value): ?TireBrand
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
