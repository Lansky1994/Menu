<?php

namespace App\Controller;

use App\Repository\MenuItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/menu")
 */
class MenuItemController extends AbstractController
{
    private $menuItemRepository;

    public function __construct(MenuItemRepository $menuItemRepository)
    {
        $this->menuItemRepository = $menuItemRepository;
    }

    /**
     * @Route ("/guest", name="menu_guest", methods={"GET"})
     */
    public function GetGuestMenu(): JsonResponse
    {

        $menuItems = $this->menuItemRepository->findAllCoursByProject();

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
        return new JsonResponse($resp);
    }
}
