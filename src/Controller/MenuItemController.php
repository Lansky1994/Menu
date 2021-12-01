<?php

namespace App\Controller;

use App\Interfaces\MenuRoleInterfaces;
use App\Model\GetMenuItem;
use App\Model\AddMenuItem;

use App\Model\UpdateMenuItem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/menu")
 */
class MenuItemController extends AbstractController
{

    /**
     * @Route ("/item/{alias}", name="menu_guest", methods={"GET"})
     */
    public function GetMenuRole($alias, GetMenuItem $getMenuItem): JsonResponse
    {
        $menuRole = $getMenuItem->getMenuRole($alias,MenuRoleInterfaces::MENU_ITEM_ROLE);

        return new JsonResponse($menuRole);
    }


    /**
     * @param Request $request
     * @param AddMenuItem $menuItem
     * @return JsonResponse
     * @Route("", name="add_menu_item", methods={"POST"})
     */
    public function addMenuItem(Request $request,AddMenuItem $menuItem): JsonResponse
    {
        $data = $menuItem->beforeDecorator(json_decode($request->getContent(), true));
        $validate = $menuItem->validate($data);

        $response = $menuItem->saveMenuItem($data);
        return new JsonResponse($validate ? $response : null,
            $validate ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param $id
     * @return JsonResponse
     * @Route ("/{id}", name="update_menu_item", methods={"PUT"})
     */
    public function updateMenu(int $id, UpdateMenuItem $updateMenuItem, Request $request): JsonResponse
    {
        $data = $updateMenuItem->beforeDecorator(json_decode($request->getContent(), true));
        $validate = $updateMenuItem->validate($data);


        $response = $updateMenuItem->updateItem($id, $data);

        return new JsonResponse($validate ? $response : null,
        $validate ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
