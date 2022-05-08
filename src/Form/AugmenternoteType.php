<?php

namespace App\Form;

use App\Entity\Auteur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AugmenternoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('auteur',EntityType::class,[
            'label' => 'Entrez le nom de l\'acteur:',
            'class'=>Auteur::class
        ])
        ->add('valeur',IntegerType::class,[
            'label' => 'Entrez la valeur que vous voulez ajouter à la note du livre:',
            'required'   => false, 
        ])

        ->add('Augmenter',SubmitType::class,[   
            'attr' =>['class'=>'btn btn-primary']  
        ]);
        
    
    }
}