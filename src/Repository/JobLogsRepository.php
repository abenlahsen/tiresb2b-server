<?php

namespace App\Repository;

use App\Entity\JobLogs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method JobLogs|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobLogs|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobLogs[]    findAll()
 * @method JobLogs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobLogsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JobLogs::class);
    }

    // /**
    //  * @return JobLogs[] Returns an array of JobLogs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Historique
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getLatestLog (): ?JobLogs
    {
        return $this->createQueryBuilder('l')
            ->orderBy('l.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
