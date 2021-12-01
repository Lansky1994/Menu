<?php

namespace App\Model;

use App\Interfaces\MenuRoleInterfaces;
use App\Repository\MenuItemRepository;
use App\Repository\MenuRepository;


class GetMenuItem implements MenuRoleInterfaces
{
    private $menuItemRepository;
    private MenuRepository $menuRepository;

    public function __construct(MenuItemRepository $menuItemRepository, MenuRepository $menuRepository)
    {
        $this->menuItemRepository = $menuItemRepository;
        $this->menuRepository = $menuRepository;
    }

    public function getChildren($id, $menuItems) {
        $childrens = [];
        foreach ($menuItems as $mi) {
            if ($mi->getMenuItem() !== null && $mi->getMenuItem()->GetId() == $id) {
             $newClidren = [
                'id' => $mi->getId(),
                'title' => $mi->getTitle(),
            ];
                $child = $this->getChildren($mi->getID(), $menuItems);

                if (count($child)) {
                    $newClidren['children'] = $child;
                }
                $childrens[] = $newClidren;
            }
        }
        return $childrens;
    }

    public function getMenuRole($alias, $id)
    {
        $menuItems = $this->menuItemRepository->findAllCoursByProject($alias, $id);
        $menu = $this->menuRepository->findBy(['alias' => $alias, 'showMenu' => true]);

        $resp = [];

        foreach ($menu as $m){

            $firstMenu = [
                "id" => $m->getId(),
                "title" => $m->getTitle(),
                "alias" => $m->getAlias(),
            ];

            foreach ($menuItems as $menuItem){
                if ($menuItem->getMenuItem() == null && $menuItem->getParent()->getId() == $m->getId())
                {
                    $sub = [
                        "id" => $menuItem->getId(),
                        "title" => $menuItem->getTitle(),
                        "alias" => $menuItem->getAlias(),
                    ];
                    $childrens = $this->getChildren($menuItem->getId(), $menuItems);

                    if (count($childrens)) {
                        $sub['children'] =  $childrens;
                    }
                    $firstMenu['children'][] = $sub;
                }
            }
            $resp[] = $firstMenu;
        }
        return $resp;
    }

}