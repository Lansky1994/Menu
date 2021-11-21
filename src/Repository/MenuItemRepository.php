<?php

namespace App\Repository;

use App\Entity\MenuItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;


/**
 * @method MenuItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method MenuItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method MenuItem[]    findAll()
 * @method MenuItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuItemRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        $this->manager = $manager;

        parent::__construct($registry, MenuItem::class);
   }

    public function getMenuGuest()
    {
        $rsm = new ResultSetMapping();
        $query = $this->manager->createNativeQuery('SELECT menu_item.ID, menu_item.PARENT_ID, menu_item.MENU_ITEM, menu_item.TITLE, menu_item.ALIAS, menu_item.ICON, menu_item.TARGET_WIN, menu_item.CREATED_USER, menu_item.CREATED_DATE, menu_item.CHANGED_USER, menu_item.CHANGED_DATE 
FROM menu_item
inner join menu_item_role on menu_item_role.ID_MENU_ITEM = menu_item.ID 
inner join role on role.ID = menu_item_role.ID_ROLE 
where role.ROLE_NAME = "GUEST";', $rsm);

        $users = $query->getResult();

        return $users;
    }

    public function findAllGreaterThanPrice()
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m
            FROM App\Entity\MenuItem m
            JOIN m.idRole r
            WHERE r.id = 3');

        // returns an array of Product objects
        return $query->getResult();
    }


    public function findAllCoursByProject()
    {
        return $this->createQueryBuilder('m')
            ->join('m.idRole', 'r')
            ->where('r = :project')
            ->setParameter('project', 3)
            ->getQuery()
            ->getResult()
            ;
    }
    // /**
    //  * @return MenuItem[] Returns an array of MenuItem objects
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
    public function findOneBySomeField($value): ?MenuItem
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
