<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MenuItem
 *
 * @ORM\Table(name="menu_item", indexes={@ORM\Index(name="fk_menu_item_id_idx", columns={"MENU_ITEM"}), @ORM\Index(name="fk_parent_id_idx", columns={"PARENT_ID"})})
 * @ORM\Entity
 */
class MenuItem
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
     * @var string|null
     *
     * @ORM\Column(name="ICON", type="string", length=100, nullable=true)
     */
    private $icon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TARGET_WIN", type="string", length=10, nullable=true)
     */
    private $targetWin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CREATED_USER", type="string", length=100, nullable=true)
     */
    private $createdUser;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="CREATED_DATE", type="datetime", nullable=true)
     */
    private $createdDate;

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

    /**
     * @var \MenuItem
     *
     * @ORM\ManyToOne(targetEntity="MenuItem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MENU_ITEM", referencedColumnName="ID")
     * })
     */
    private $menuItem;

    /**
     * @var \Menu
     *
     * @ORM\ManyToOne(targetEntity="Menu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="PARENT_ID", referencedColumnName="ID")
     * })
     */
    private $parent;

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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getTargetWin(): ?string
    {
        return $this->targetWin;
    }

    public function setTargetWin(?string $targetWin): self
    {
        $this->targetWin = $targetWin;

        return $this;
    }

    public function getCreatedUser(): ?string
    {
        return $this->createdUser;
    }

    public function setCreatedUser(?string $createdUser): self
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

    public function getMenuItem(): ?self
    {
        return $this->menuItem;
    }

    public function setMenuItem(?self $menuItem): self
    {
        $this->menuItem = $menuItem;

        return $this;
    }

    public function getParent(): ?Menu
    {
        return $this->parent;
    }

    public function setParent(?Menu $parent): self
    {
        $this->parent = $parent;

        return $this;
    }


}
