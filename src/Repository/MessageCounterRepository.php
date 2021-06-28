<?php

namespace App\Repository;

use App\Entity\MessageCounter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MessageCounter|null find($id, $lockMode = null, $lockVersion = null)
 * @method MessageCounter|null findOneBy(array $criteria, array $orderBy = null)
 * @method MessageCounter[]    findAll()
 * @method MessageCounter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageCounterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MessageCounter::class);
    }

    // /**
    //  * @return MessageCounter[] Returns an array of MessageCounter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MessageCounter
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
