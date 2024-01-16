<?php

namespace App\Form;

use App\Entity\Contrat;
use App\Entity\Staff;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StaffType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('birth_')
            ->add('number_cin')
            ->add('number_matricule')
            ->add('adresse_exact')
            ->add('work_post')
            ->add('phone_number')
            ->add('situation_family')
            ->add('civility')
            ->add('nationality')
            ->add('email')
            ->add('code_postal')
            ->add('number_child')
            ->add('lieu')
            ->add('salary_base')
            ->add('date_begin')
            ->add('date_end')
            ->add('hours_per_week')
            ->add('day_per_week')
            ->add('horary')
            ->add('contratType', EntityType::class, [
                'class' => Contrat::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Staff::class,
        ]);
    }
}
