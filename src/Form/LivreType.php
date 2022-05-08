<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isbn' , TextType::class)
        
            ->add('titre')
            ->add('nbpages')
            ->add('date_de_parution', DateType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'type' => 'date'
                ],
                'widget' => 'single_text'
            ])
            ->add('note')
            ->add('auteurs')
            ->add('genres')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
