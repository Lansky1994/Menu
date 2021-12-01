<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MenuItemRole
 *
 * @ORM\Table(name="menu_item_role", indexes={@ORM\Index(name="fk_id_menu_item_idx", columns={"ID_MENU_ITEM"})})
 * @ORM\Entity(repositoryClass="App\Repository\MenuItemRoleRepository")
 */
class MenuItemRole
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="ID_ROLE", type="integer", nullable=false)
     */
    private $idRole;

    /**
     * @var \MenuItem
     *
     * @ORM\ManyToOne(targetEntity="MenuItem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_MENU_ITEM", referencedColumnName="ID")
     * })
     */
    private $idMenuItem;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRole(): ?int
    {
        return $this->idRole;
    }

    public function setIdRole(int $idRole): self
    {
        $this->idRole = $idRole;

        return $this;
    }

    public function getIdMenuItem(): ?MenuItem
    {
        return $this->idMenuItem;
    }

    public function setIdMenuItem(?MenuItem $idMenuItem): self
    {
        $this->idMenuItem = $idMenuItem;

        return $this;
    }


}
