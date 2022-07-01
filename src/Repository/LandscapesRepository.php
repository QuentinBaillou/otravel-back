<?php

namespace App\Repository;

use App\Entity\Landscapes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Landscapes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Landscapes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Landscapes[]    findAll()
 * @method Landscapes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LandscapesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Landscapes::class);
    }

    // /**
    //  * @return Landscapes[] Returns an array of Landscapes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Landscapes
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
