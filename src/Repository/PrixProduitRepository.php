<?php

namespace App\Repository;

use App\Entity\PrixProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PrixProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrixProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrixProduit[]    findAll()
 * @method PrixProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrixProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrixProduit::class);
    }

    // /**
    //  * @return PrixProduit[] Returns an array of PrixProduit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrixProduit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
