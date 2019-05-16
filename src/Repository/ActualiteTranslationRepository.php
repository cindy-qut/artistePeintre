<?php

namespace App\Repository;

use App\Entity\ActualiteTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ActualiteTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActualiteTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActualiteTranslation[]    findAll()
 * @method ActualiteTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActualiteTranslationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ActualiteTranslation::class);
    }

    // /**
    //  * @return ActualiteTranslation[] Returns an array of ActualiteTranslation objects
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

    /*
    public function findOneBySomeField($value): ?ActualiteTranslation
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
