<?php

namespace App\Repository\Tire;

use App\Entity\Tire\TireProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Func;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;

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

    public function paginatorQuery($orderBy): QueryBuilder
    {
        if (!$orderBy) {
            $orderBy = 'id';
        }

        $qb = $this->createQueryBuilder('p')
            ->orderBy("p.$orderBy", 'ASC');

        return $qb;
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
            ORDER BY tire_height.height
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['width' => $width]);

       return $stmt->fetchAllAssociative();
    }

    public function findRimByWidthAndHeight($width, $height)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT DISTINCT tire_rim_size.size, tire_rim_size.id 
            FROM tire_product
            INNER JOIN tire_rim_size
            ON tire_product.rim_size_id=tire_rim_size.id
            WHERE width_id = :width
            AND height_id = :height
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['width' => $width, 'height' => $height]);

        return $stmt->fetchAllAssociative();
    }

    /**
     * @return QueryBuilder|[]
     */
    public function findByAny(Request $request, $expr = null)
    {
        $width = $request->query->getInt('width');
        $height = $request->query->getInt('height');
        $rimSize = $request->query->getInt('rimSize');
        $seasons = $request->query->get('seasons');
        $brands = $request->query->get('brands');

        $q = $this->createQueryBuilder('t');
        $q->innerJoin('t.model', 'm');
        $q->innerJoin('m.brand', 'b');

       if ($width) {
           $q->andWhere("t.width = $width");
       }
       if ($height) {
           $q->andWhere("t.height = $height");
       }
       if ($rimSize) {
           $q->andWhere("t.rimSize = $rimSize");
       }
       if ($seasons) {
           if (count($seasons) > 1) {
               $qr = "";
               foreach ($seasons as $season) {
                   $qr .= "m.season = '$season' OR ";
               }
               $qr = substr($qr, 0, -3);
           } else {
               $qr = "m.season = '$seasons[0]'";
           }
           $q->andWhere($qr);
       }
       if ($brands && $brands[0] != 'null') {
           if (count($brands) > 1) {
               $qry = "";
               foreach ($brands as $brand) {
                   $qry .= "b.id = $brand OR ";
               }
               $qry = substr($qry, 0, -3);
           } else {
               $qry = "b.id = $brands[0]";
           }
           $q->andWhere($qry);
       }

       if ($expr === 'max') {
           return $q->select('MAX(t.price)')->getQuery()->getSingleScalarResult();
       } elseif ($expr === 'min') {
           return $q->select('MIN(t.price)')->getQuery()->getSingleScalarResult();
       } else {
           return $q;
       }
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
