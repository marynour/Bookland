<?php

namespace App\Repository;

use App\Entity\Auteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Auteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Auteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Auteur[]    findAll()
 * @method Auteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Auteur::class);
    }
    //action 16
    public function findBylivre()
    {
        return $this->createQueryBuilder('a')
            
            ->join('a.livres' , 'l')
            ->groupBy('a.nom_prenom') 
            ->having('COUNT(l.id) >= :some_count')
            ->setParameter('some_count', 3)
            ->getQuery()
            ->getResult()
            
        ;
    }
//Action 20 
public function findBygenre($auteur)
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('a.livres' , 'l')
            ->innerJoin('l.genres' , 'g')
            ->where('a.nom_prenom = :nom')
            ->orderBy('l.date_de_parution','asc')
            ->setParameter('nom',$auteur)
            ->getQuery()
            ->getResult()
            
        ;
    }

    // /**
    //  * @return Auteur[] Returns an array of Auteur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function findBygenrechrono($id)
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('a.livres' , 'l')
            ->innerJoin('l.genres' , 'g')
            ->where('a.id = :id')
           
            ->setParameter('id',$id)
            ->orderBy('l.date_de_parution')
            ->getQuery()
            ->getResult()
            
        ;
    }
    /*
    public function findOneBySomeField($value): ?Auteur
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
