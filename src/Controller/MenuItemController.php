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

        foreach ($menuItems as $menuItem){
            if ($menuItem->getParent() != null) {
                $isSet = false;
                $sub = [
                    "id" => $menuItem->getId(),
                    "title" => $menuItem->getTitle(),
                    "alias" => $menuItem->getAlias(),
                    "children" => [],
                ];
                foreach ($resp as $value) {
                    if ($value["id"] == $menuItem->getParent()->getId()) {
                        $isSet = true;
                        $resp["children"][] = $sub;
                    }
                }

                if (!$isSet) {
                    $resp[] = [
                        "id" => $menuItem->getParent()->getId(),
                        "title" => $menuItem->getParent()->getTitle(),
                        "alias" => $menuItem->getParent()->getAlias(),
                        "children" => [$sub]
                    ];
                }


            }

        }

        foreach ($menuItems as $menuItem) {
            if ($menuItem->getParent() == null) {
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
