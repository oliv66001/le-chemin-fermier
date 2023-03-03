<?php

namespace App\Form;

use App\Entity\Calendar;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('start', DateTimeType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('nbOfPeople', IntegerType::class, [
                'label' => 'Nombre de personnes',
                'attr' => ['min' => '1', 'max' => '12',
                    'minMessage' => 'Vous devez réserver pour au moins une personne',
                    'maxMessage' => 'Vous ne pouvez pas réserver pour plus de 12 personnes merci de nous contacter'
                ],
                ])
            ->add('reservationTable', EntityType::class, [
                'class' => 'App\Entity\User',
                'choice_label' => 'username',
                'label' => 'Nom de la table',
                'placeholder' => 'Choisissez une table',
                'attr' => ['class' => 'js-select'],
                'query_builder' => function (\Doctrine\ORM\EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.roles LIKE :role')
                        ->setParameter('role', '%"ROLE_TABLE"%');

                
                }

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
