<?php

namespace App\Repository\Tire;

use App\Entity\Tire\TireModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TireModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method TireModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method TireModel[]    findAll()
 * @method TireModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TireModelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TireModel::class);
    }

    // /**
    //  * @return TireModel[] Returns an array of TireModel objects
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
    public function findOneBySomeField($value): ?TireModel
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
