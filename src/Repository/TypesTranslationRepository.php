<?php

namespace App\Repository;

use App\Entity\TypesTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypesTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypesTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypesTranslation[]    findAll()
 * @method TypesTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypesTranslationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypesTranslation::class);
    }

    // /**
    //  * @return TypesTranslation[] Returns an array of TypesTranslation objects
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
    public function findOneBySomeField($value): ?TypesTranslation
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
