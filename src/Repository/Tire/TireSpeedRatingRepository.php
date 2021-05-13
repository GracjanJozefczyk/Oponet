<?php

namespace App\Repository\Tire;

use App\Entity\Tire\TireSpeedRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TireSpeedRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method TireSpeedRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method TireSpeedRating[]    findAll()
 * @method TireSpeedRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TireSpeedRatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TireSpeedRating::class);
    }

    // /**
    //  * @return TireSpeedRating[] Returns an array of TireSpeedRating objects
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
    public function findOneBySomeField($value): ?TireSpeedRating
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
        return $this->findBy(array(), array('speedRating' => 'ASC'));
    }
}
