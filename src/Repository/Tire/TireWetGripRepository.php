<?php

namespace App\Repository\Tire;

use App\Entity\Tire\TireWetGrip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TireWetGrip|null find($id, $lockMode = null, $lockVersion = null)
 * @method TireWetGrip|null findOneBy(array $criteria, array $orderBy = null)
 * @method TireWetGrip[]    findAll()
 * @method TireWetGrip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TireWetGripRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TireWetGrip::class);
    }

    // /**
    //  * @return TireWetGrip[] Returns an array of TireWetGrip objects
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
    public function findOneBySomeField($value): ?TireWetGrip
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
        return $this->findBy(array(), array('wetGrip' => 'ASC'));
    }
}
