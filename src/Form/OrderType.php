<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Carrier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //dd($options);
        $user = $options['user'];

        $builder
            ->add('addresses', EntityType::class, [
                'label' => 'Choisissez votre adresse de livraison',
                'required' => true,
                'class' => Address::class,
                'choices' => $user->getAddresses(), /* Me permet de récupérer uniquement les adresses de l'utilisateur et non pas des autres */
                'multiple' => false,
                'expanded' => true
            ])
            ->add('carriers', EntityType::class, [
                'label' => 'Choisissez votre trasnporteur',
                'required' => true,
                'class' => Carrier::class,
                'multiple' => false,
                'expanded' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider ma commande',
                'attr' => [
                    'class' => 'btn btn-success btn-block'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'user' => array()
        ]);
    }
}
