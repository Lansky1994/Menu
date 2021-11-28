<?php

namespace App\Model;

use App\Repository\MenuItemRepository;


class GetMenuItem
{
    private $menuItemRepository;

    public function __construct(MenuItemRepository $menuItemRepository)
    {
        $this->menuItemRepository = $menuItemRepository;
    }

    public function getMenuRole($id)
    {
        $menuItems = $this->menuItemRepository->findAllCoursByProject($id);

        $resp = [];

        // Ищем меню айтем у которого есть родитель
        foreach ($menuItems as $menuItem){
            if ($menuItem->getParent() != null)
            {
                $isSet = false;
                $sub = [
                    "id" => $menuItem->getId(),
                    "title" => $menuItem->getTitle(),
                    "alias" => $menuItem->getAlias(),
                ];

                // Нет ли у нас поля в таблице меню проверяем
                foreach ($resp as $index => $value) {
//                    echo "<pre>";
//                    print_r($value);
//                    echo "</pre>";
                    if ($value["id"] == $menuItem->getParent()->getId())
                    {
                        $isSet = true;
                        $resp[$index]["children"][] = $sub;
                    }
                }

                //Создаем родителя
                if (!$isSet)
                {
                    $resp[] = [
                        "id" => $menuItem->getParent()->getId(),
                        "title" => $menuItem->getParent()->getTitle(),
                        "alias" => $menuItem->getParent()->getAlias(),
                        "children" => [$sub]
                    ];
                }
            }
        }

        //Смотрим подпункты у которых нет меню айди -> родителя
        foreach ($menuItems as $menuItem) {

            if ($menuItem->getParent() == null)
            {
                //Засовываем под меню в под меню
                foreach ($resp as $key=>$value) {
                    foreach ($value["children"] as $j=>$c) {
                        if ($c["id"] == $menuItem->getMenuItem()->getId()) {
                            $sub = [
                                "id" => $menuItem->getId(),
                                "title" => $menuItem->getTitle(),
                                "alias" => $menuItem->getAlias(),
                            ];

                            $resp[$key]["children"][$j]["children"][]=$sub;
                        }

                    }
                }
            }
        }
        return $resp;
    }

}