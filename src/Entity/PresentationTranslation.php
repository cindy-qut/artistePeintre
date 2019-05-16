<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PresentationTranslationRepository")
 */
class PresentationTranslation
{
    use ORMBehaviors\Translatable\Translation;

    /**
     * @ORM\Column(type="text")
     */
    private $biographie;



    public function getBiographie(): ?string
    {
        return $this->biographie;
    }

    public function setBiographie(string $biographie): self
    {
        $this->biographie = $biographie;

        return $this;
    }
}
