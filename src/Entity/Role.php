<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role
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
     * @var string
     *
     * @ORM\Column(name="ROLE_NAME", type="string", length=100, nullable=false)
     */
    private $roleName;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="MenuItem", mappedBy="idRole")
     */
    private $idMenuItem;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idMenuItem = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleName(): ?string
    {
        return $this->roleName;
    }

    public function setRoleName(string $roleName): self
    {
        $this->roleName = $roleName;

        return $this;
    }

    /**
     * @return Collection|MenuItem[]
     */
    public function getIdMenuItem(): Collection
    {
        return $this->idMenuItem;
    }

    public function addIdMenuItem(MenuItem $idMenuItem): self
    {
        if (!$this->idMenuItem->contains($idMenuItem)) {
            $this->idMenuItem[] = $idMenuItem;
            $idMenuItem->addIdRole($this);
        }

        return $this;
    }

    public function removeIdMenuItem(MenuItem $idMenuItem): self
    {
        if ($this->idMenuItem->removeElement($idMenuItem)) {
            $idMenuItem->removeIdRole($this);
        }

        return $this;
    }

}
