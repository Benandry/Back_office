<?php

namespace App\Form;

use App\Entity\Staff;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StaffFormType extends AbstractType
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
            ->add('submit', SubmitType::class, [
                'label' => 'New Staff'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Staff::class,
        ]);
    }
}
