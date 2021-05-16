<?php

namespace App\Repository\Tire;

use App\Entity\Tire\TireProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TireProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method TireProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method TireProduct[]    findAll()
 * @method TireProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TireProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TireProduct::class);
    }

    public function findWidthsByRimSize($rimSize)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT DISTINCT tire_width.width, tire_width.id 
            FROM tire_product
            INNER JOIN tire_width
            ON tire_product.width_id=tire_width.id
            WHERE rim_size_id = :rimSize
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['rimSize' => $rimSize]);

       return $stmt->fetchAllAssociative();
    }

    public function findHeightsByWidth($width)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT DISTINCT tire_height.height, tire_height.id 
            FROM tire_product
            INNER JOIN tire_height
            ON tire_product.height_id=tire_height.id
            WHERE width_id = :width
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['width' => $width]);

        return $stmt->fetchAllAssociative();
    }

    // /**
    //  * @return TireProduct[] Returns an array of TireProduct objects
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
    public function findOneBySomeField($value): ?TireProduct
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
