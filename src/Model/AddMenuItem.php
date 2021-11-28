<?php

namespace App\Model;

use App\Entity\Menu;
use App\Entity\MenuItem;
use App\Entity\Role;
use App\Repository\MenuItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;


class AddMenuItem
{
    private $menuItemRepository;
    private $entityManager;

    public function __construct(MenuItemRepository $menuItemRepository, EntityManagerInterface $entityManager)
    {
        $this->menuItemRepository = $menuItemRepository;
        $this->entityManager = $entityManager;
    }

    public function beforeDecorator($data)
    {
        $response = [
            'parentId' => $data['parentId'],
            'menuItem' => $data['menuItem'],
            'title' => $data['title'],
            'alias' => $data['alias'],
            'icon' => $data['icon'],
            'roles' => $data['roles'],
        ];

        return $response;
    }

    public function validate($data): bool
    {
        $validator = Validation::createValidator();

        $constraint = new Assert\Collection([
            // the keys correspond to the keys in the input array
            'parentId' => new Assert\Optional([
                new Assert\AtLeastOneOf([
                    new Assert\Type('int'),
                    new Assert\IsNull()
                ])
            ]),
            'menuItem' => new Assert\Optional([
                new Assert\AtLeastOneOf([
                    new Assert\Type('int'),
                    new Assert\IsNull()
                ])
            ]),
            'title' => new Assert\NotNull(),
            'alias' => new Assert\NotNull(),
            'icon' => new Assert\NotNull(),
            'roles' => new Assert\Required([
                new Assert\Type('array'),
                new Assert\All([
                    new Assert\Type('int'),
                    new Assert\AtLeastOneOf([
                        new Assert\IsNull(),
                        new Assert\Type('int'),
                    ])
                ])
            ]),
        ]);

        $violations = $validator->validate($data, $constraint);

        if (count($violations) > 1){
            return false;
        }
        return true;
    }

    public function saveMenuItem($data)
    {
        if (!empty($data['menuItem']) and !empty($data['parentId'])){
            throw new \Exception('Два айди нельзя заполнить');
        }

        if (!empty($data['parentId'])){
            $parentId = $this->entityManager->getRepository(Menu::class)->find($data['parentId']);
        }else{
            $parentId = null;
        }

        if (!empty($data['menuItem'])){
            $menuId = $this->entityManager->getRepository(MenuItem::class)->find($data['menuItem']);
        }else{
            $menuId = null;
        }

        $roleId = [];
        if (!empty($data['roles'])){
            foreach ($data['roles'] as $role){
                $roles = $this->entityManager->getRepository(Role::class)->find($role);
                if (is_null($roles)){
                    throw new \Exception('Ошибка роли');
                }
                $roleId[] = $roles;
            }
        }


        $newMenuItem = new MenuItem();

        $newMenuItem
            ->setParent($parentId)
            ->setMenuItem($menuId)
            ->setTitle($data['title'])
            ->setAlias($data['alias'])
            ->setIcon($data['icon']);
            if ($roleId !== null){
                foreach ($roleId as $role){
                    $newMenuItem->addIdRole($role);
                }
            }

            $this->entityManager->persist($newMenuItem);
            $this->entityManager->flush();

    }

}