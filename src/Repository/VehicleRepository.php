<?php

namespace App\Repository;

use App\Entity\Vehicle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vehicle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicle[]    findAll()
 * @method Vehicle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicle::class);
    }

    // /**
    //  * @return Vehicle[] Returns an array of Vehicle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vehicle
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function searchAndSortAllQueryBuilder($search = '', $column, $sort)
    {

        $column = $column == '' ? 'Id' : $column;
        $sort = $sort == '' ? 'ASC' : $sort;
        $search = $search == '' ? '%' : $search;

        $qb = $this->createQueryBuilder('v');
        if ($search && $column && $sort) {
            $qb->andWhere('v.Id LIKE :search OR v.Date LIKE :search OR v.Type LIKE :search OR v.Msrp LIKE :search OR v.Year LIKE :search OR v.Make LIKE :search OR v.Model LIKE :search OR v.Miles LIKE :search OR v.Vin LIKE :search or v.Deleted LIKE :search')
                ->setParameter('search', '%'.$search.'%')
                ->orderBy('v.'.$column, $sort);
        }
        return $qb;
    }
}
