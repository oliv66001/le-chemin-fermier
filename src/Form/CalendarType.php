<?php

namespace App\Form;



use App\Entity\Calendar;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;



class CalendarType extends AbstractType
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $hours = [
            '12:00' => '12:00',
            '12:30' => '12:30',
            '13:00' => '13:00',
            '13:30' => '13:30',
            '19:00' => '19:00',
            '19:30' => '19:30',
            '20:00' => '20:00',
            '20:30' => '20:30',
            '21:00' => '21:00',
    ];

        $current_user = $this->security->getUser();
        $current_user_lastname = $current_user ? $current_user->getLastname() : null;

        $builder
            ->add('dateStart', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de la réservation : ',
                'attr' => ['class' => 'js-datepicker form-group'],
            ])

            ->add('timeStart', ChoiceType::class, [
                'choices' => $hours,
                'label' => 'Heure de la réservation : ',
                'attr' => [
                    'class' => 'btn form-group',
                ],
               
                    ])
              
            ->add('nbOfPeople', IntegerType::class, [
                'label' => 'Nombre de personnes',
                'attr' => [
                    'min' => '1', 'max' => '12',
                    'minMessage' => 'Vous devez réserver pour au moins une personne',
                    'maxMessage' => 'Vous ne pouvez pas réserver pour plus de 12 personnes merci de nous contacter',
                    'class' => 'form-group',
                ],
            ])

            ->add('reservationTable', TextType::class, [
                'label' => 'Vous réservez pour : ',
                'data' => $current_user_lastname,
                'disabled' => true,
                'attr' => ['class' => 'btn form-group'],
                
            ]);
        }
            
        
//           ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
//               $data = $event->getData();
//               $timeStart = $data->getTimeStart();
//               if (is_string($timeStart)) {
//                   $data->setTimeStart(new DateTime($timeStart));
//               }
//           });
//   }
   
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
