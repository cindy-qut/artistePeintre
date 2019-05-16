<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypesRepository")
 */
class Types
{
    use ORMBehaviors\Translatable\Translatable;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Images", cascade={"persist", "remove"})
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString()
    {
        return $this->getId();
    }

    public function getImage(): ?Images
    {
        return $this->image;
    }

    public function setImage(?Images $image): self
    {
        $this->image = $image;

        return $this;
    }
}
