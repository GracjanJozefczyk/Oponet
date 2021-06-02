<?php

namespace App\Repository\Tire;

use App\Entity\Tire\TireBrand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
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

    public function paginatorQuery($orderBy, $name): QueryBuilder
    {
        if (!$orderBy) {
            $orderBy = 'id';
        }

        $q = $this->createQueryBuilder('b')
            ->orderBy("b.$orderBy", 'ASC');

        if ($name) {
            $q->andWhere('b.name LIKE :name');
            $q->setParameter('name', '%'.$name.'%');
        }

        return $q;
    }

    public function getFirst()
    {
        return $this->findOneBy([], []);
    }

    public function autocomplete($string): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT DISTINCT name
            FROM tire_brand
            WHERE name LIKE :string
            ORDER BY name
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['string' => '%'.$string.'%']);

        return $stmt->fetchAllAssociative();
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
