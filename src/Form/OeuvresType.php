<?php

namespace App\Form;

use App\Entity\Types;
use App\Entity\Images;
use App\Entity\Oeuvres;
use App\Entity\Taille;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use A2lix\TranslationFormBundle\Form\Type\TranslationsType;

class OeuvresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translations', TranslationsType::class)
            ->add('image',ImagesType::class)
            ->add('type', EntityType::class,array(
                'class' => Types::class,
                'choice_label' => function($types)
                {
                    return $types->getId();
                }
            ))
            ->add('taille', EntityType::class,array(
                'class' => Taille::class,
                'choice_label' => function($taille)
                {
                return $taille->getDimensions();
                }
            ))
            ->add('tarif')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Oeuvres::class,
        ]);
    }
}
