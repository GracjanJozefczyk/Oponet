<?php

namespace App\Repository\Tire;

use App\Entity\Tire\TireRimSize;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TireRimSize|null find($id, $lockMode = null, $lockVersion = null)
 * @method TireRimSize|null findOneBy(array $criteria, array $orderBy = null)
 * @method TireRimSize[]    findAll()
 * @method TireRimSize[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TireRimSizeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TireRimSize::class);
    }

    public function findAllAndSort()
    {
        return $this->findBy(array(), array('size' => 'ASC'));
    }

    // /**
    //  * @return TireRimSize[] Returns an array of TireRimSize objects
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
    public function findOneBySomeField($value): ?TireRimSize
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
