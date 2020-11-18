<?php

namespace App\Repository;

use App\Entity\Recipy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recipy|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipy|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipy[]    findAll()
 * @method Recipy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipy::class);
    }

    // /**
    //  * @return Recipy[] Returns an array of Recipy objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recipy
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
