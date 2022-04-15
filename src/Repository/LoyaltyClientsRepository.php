<?php

namespace App\Repository;

use App\Entity\LoyaltyClients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LoyaltyClients|null find($id, $lockMode = null, $lockVersion = null)
 * @method LoyaltyClients|null findOneBy(array $criteria, array $orderBy = null)
 * @method LoyaltyClients[]    findAll()
 * @method LoyaltyClients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LoyaltyClientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LoyaltyClients::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(LoyaltyClients $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(LoyaltyClients $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return LoyaltyClients[] Returns an array of LoyaltyClients objects
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
    public function findOneBySomeField($value): ?LoyaltyClients
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
