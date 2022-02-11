<?php

namespace App\Repository;

use App\Entity\TermSet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TermSet|null find($id, $lockMode = null, $lockVersion = null)
 * @method TermSet|null findOneBy(array $criteria, array $orderBy = null)
 * @method TermSet[]    findAll()
 * @method TermSet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TermSetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TermSet::class);
    }

    // /**
    //  * @return TermSet[] Returns an array of TermSet objects
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
    public function findOneBySomeField($value): ?TermSet
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
