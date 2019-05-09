<?php

namespace App\Repository;

use App\Entity\OeuvresTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OeuvresTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method OeuvresTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method OeuvresTranslation[]    findAll()
 * @method OeuvresTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OeuvresTranslationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OeuvresTranslation::class);
    }

    // /**
    //  * @return OeuvresTranslation[] Returns an array of OeuvresTranslation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OeuvresTranslation
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
