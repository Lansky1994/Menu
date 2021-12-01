<?php

namespace App\Repository;

use App\Entity\MenuItemRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MenuItemRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method MenuItemRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method MenuItemRole[]    findAll()
 * @method MenuItemRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuItemRoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MenuItemRole::class);
    }

    // /**
    //  * @return MenuItemRole[] Returns an array of MenuItemRole objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MenuItemRole
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
