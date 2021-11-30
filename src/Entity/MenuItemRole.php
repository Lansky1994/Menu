<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MenuItemRole
 *
 * @ORM\Table(name="menu_item_role", indexes={@ORM\Index(name="IDX_8619A9A54CCF0CB3", columns={"ID_MENU_ITEM"})})
 * @ORM\Entity
 */
class MenuItemRole
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_ROLE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idRole;

    /**
     * @var \MenuItem
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="MenuItem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_MENU_ITEM", referencedColumnName="ID")
     * })
     */
    private $idMenuItem;

    public function getIdRole(): ?int
    {
        return $this->idRole;
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
