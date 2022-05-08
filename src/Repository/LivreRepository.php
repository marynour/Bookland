<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Statement;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\Result;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    // /**
    //  * @return Livre[] Returns an array of Livre objects
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
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    //Action 13
    public function findByDate($Date1,$Date2)
    {
        return $this->createQueryBuilder('l')
            ->Where('l.date_de_parution >= :date1')
            ->andWhere('l.date_de_parution <= :date2')
            ->setParameters(
                array(
                    'date1'=>$Date1,
                    'date2'=>$Date2,
                )
            )
           
            ->getQuery()
            ->getResult()
        ;
    }

    //Action 15 
    public function findByDateandnote($date1,$date2,$note1,$note2)
    {
       
        return $this->createQueryBuilder('l')
            ->Where('l.date_de_parution >= :date1')
            ->andWhere('l.date_de_parution <= :date2')
            ->andWhere('l.note >= :note1')
            ->andWhere('l.note <= :note2')
            ->setParameters(
                array(
                    'date1'=>$date1,
                    'date2'=>$date2,
                    'note1'=>$note1,
                    'note2'=>$note2,

                ) 
            )

            ->getQuery()
            ->getResult()
        ;
    }

//Action 19
public function findBypagenumber($genre){
    return $this->createQueryBuilder('l')
    ->select('sum(l.nbpages) as somme') 
    ->innerjoin('l.genres' , 'g')
    ->where('g.nom =:genrenom')
    ->setParameter('genrenom',$genre)
    ->getQuery()
    ->getResult()
    
;
}
//Action 22
public function findBypagenumbermoyenne($genre){
    return $this->createQueryBuilder('l')
    ->select('AVG(l.nbpages) as moyenne') 
    ->innerjoin('l.genres' , 'g')
    ->where('g.nom =:genrenom')
    ->setParameter('genrenom',$genre)
    ->getQuery()
    ->getResult()
    
;
}
//Action 25
public function findBypartietitre($titre)
{
    return $this->createQueryBuilder('l')
    ->where('l.titre LIKE :titre')
    ->setParameter('titre', "%$titre%")
    ->getQuery()
    ->getResult()
;
}
//Action 14 
public function findBynationality()
{
    return $this->createquerybuilder('l')
    
    ->join('l.auteurs','a')
    ->groupBy('l.id')
    ->having('COUNT(a.id)=COUNT(DISTINCT a.nationalite)')
    ->getQuery()
    ->getresult();
}

//Action 17
public function findByparite()
{
    return $this->createquerybuilder('l')
    ->join('l.auteurs','a')
    ->leftjoin('App\Entity\Auteur' , 'homme','WITH' ,'a.id=homme.id AND homme.sexe=:m')
    ->setParameter('m', 'M')
    ->leftjoin('App\Entity\Auteur' , 'femme','WITH' ,'a.id=femme.id AND femme.sexe=:f')
    ->setParameter('f', 'F')
    ->groupBy('l.id')
    ->having('COUNT(homme.id)=COUNT(femme.id)')
    ->getQuery()
    ->getresult();
}

    /*public function findB2($titre)
    {
        return $this->createQueryBuilder("l")
            ->select( 'l.titre' )
             ->leftJoin(
            'App\Entity\Auteur',
            'a',
            'WITH',
            'l.id = a.id'
        )
            ->Where('l.titre = :titre')
            
            ->setParameters(
                array(
                    'titre'=>$titre,
                    
                )
            )
           
            ->getQuery()
            ->getResult()
        ;
    }*/
   
   
}

    

