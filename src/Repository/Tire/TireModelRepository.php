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

    public function paginatorQuery($orderBy, $brand, $model)
    {
        if (!$orderBy) {
            $orderBy = 'id';
        }

        $q = $this->createQueryBuilder('m')
            ->orderBy("m.$orderBy", 'ASC')
            ->innerJoin('m.brand', 'b');

        if ($brand) {
            $q->andWhere('b.name = :brand');
            $q->setParameter('brand', $brand);
        }

        if ($model) {
            $q->andWhere('m.name LIKE :name');
            $q->setParameter('name', '%'.$model.'%');
        }

        return $q;
    }

    public function getModelsByBrand($brand)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT tire_model.name
            FROM tire_model
            INNER JOIN tire_brand
            ON tire_model.brand_id = tire_brand.id
            WHERE tire_brand.name = :string
            ORDER BY name
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['string' => $brand]);

        return $stmt->fetchAllAssociative();
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
