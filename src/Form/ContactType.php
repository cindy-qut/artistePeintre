<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Langue;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('email')
            ->add('object')
            ->add('message')
            ->add('inscriptionnewsletter')
            ->add('rgpd', CheckboxType::class, array(
                'label'=> "En accord avec la RGPD",
                'required'=> true,
            ))
            ->add('langue', EntityType::class,array(
                'class' => Langue::class,
                'choice_label' => function($langue)
                {
                    return $langue->getNom();
                }
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
