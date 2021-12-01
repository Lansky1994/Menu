<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 */
class Menu
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
     * @ORM\Column(name="TITLE", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="ALIAS", type="string", length=100, nullable=false)
     */
    private $alias;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="SHOW_MENU", type="boolean", nullable=true, options={"default"="1"})
     */
    private $showMenu = true;

    /**
     * @var string
     *
     * @ORM\Column(name="CREATED_USER", type="string", length=100, nullable=false)
     */
    private $createdUser;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="CREATED_DATE", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdDate = 'CURRENT_TIMESTAMP';

    /**
     * @var string|null
     *
     * @ORM\Column(name="CHANGED_USER", type="string", length=100, nullable=true)
     */
    private $changedUser;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="CHANGED_DATE", type="datetime", nullable=true)
     */
    private $changedDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getShowMenu(): ?bool
    {
        return $this->showMenu;
    }

    public function setShowMenu(?bool $showMenu): self
    {
        $this->showMenu = $showMenu;

        return $this;
    }

    public function getCreatedUser(): ?string
    {
        return $this->createdUser;
    }

    public function setCreatedUser(string $createdUser): self
    {
        $this->createdUser = $createdUser;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(?\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getChangedUser(): ?string
    {
        return $this->changedUser;
    }

    public function setChangedUser(?string $changedUser): self
    {
        $this->changedUser = $changedUser;

        return $this;
    }

    public function getChangedDate(): ?\DateTimeInterface
    {
        return $this->changedDate;
    }

    public function setChangedDate(?\DateTimeInterface $changedDate): self
    {
        $this->changedDate = $changedDate;

        return $this;
    }


}
