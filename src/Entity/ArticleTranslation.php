<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleTranslationRepository")
 */
class ArticleTranslation
{
    use ORMBehaviors\Translatable\Translation;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $texte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lienpress;



    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getLienpress(): ?string
    {
        return $this->lienpress;
    }

    public function setLienpress(?string $lienpress): self
    {
        $this->lienpress = $lienpress;

        return $this;
    }
}
