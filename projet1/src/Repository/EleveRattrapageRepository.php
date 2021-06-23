<?php

namespace App\Repository;

use App\Entity\EleveRattrapage;
use App\Entity\Rattrapage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Eleve;

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

    public function getEleveByRattrapage($idRattrapage): array
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT e
            FROM App\Entity\EleveRattrapage e, App\Entity\Rattrapage r
            WHERE e.rattrapage = :test
            '
        )->setParameter('test', $idRattrapage);

        return $query->getResult();
    }


    public function updateNote($idEleve, $note){
        $em = $this->getEntityManager();    
        $query = $em->createQuery(
            'UPDATE App\Entity\EleveRattrapage e 
            SET e.Note = :note 
            WHERE e.eleve = :id '
        )->setParameter('note', $note)
        ->setParameter('id', $idEleve);

        return $query->execute();
    }

    public function getNotes($idRattrapage): array
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT e.Nom, e.Prenom, er.Note
            FROM App\Entity\EleveRattrapage er, App\Entity\Eleve e
            WHERE er.rattrapage = :test
            AND er.eleve=e.id
            '
        )->setParameter('test', $idRattrapage);

        return $query->getResult();
    }

    public function updateEtatRattrapage(){
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'UPDATE App\Entity\Rattrapage rat
            SET rat.EtatRattrapage = 2 
            WHERE ( SELECT count(e.Note) FROM App\Entity\EleveRattrapage e , App\Entity\Rattrapage r WHERE e.rattrapage = r.id ) = (SELECT COUNT(ere.id) FROM App\Entity\EleveRattrapage ere , App\Entity\Rattrapage ra  WHERE ere.rattrapage = ra.id )  '
        );

        return $query->execute();
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
