<?php

namespace App\Repository;

use App\Entity\EleveRattrapage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EleveRattrapage|null find($id, $lockMode = null, $lockVersion = null)
 * @method EleveRattrapage|null findOneBy(array $criteria, array $orderBy = null)
 * @method EleveRattrapage[]    findAll()
 * @method EleveRattrapage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EleveRattrapageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EleveRattrapage::class);
    }

    // /**
    //  * @return EleveRattrapage[] Returns an array of EleveRattrapage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EleveRattrapage
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
