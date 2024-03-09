<?php

namespace App\Form;

use App\Entity\Debilidad;
use App\Entity\Pokemon;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PokemonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('descripcion')
            ->add('ficheroImagen', FileType::class, [
                'label' => 'Sube la imagen del Pokemon',
                'mapped' => false
            ])
            ->add('codigo', NumberType::class, [
                'attr' => [
                    'placeholder' => 'inserta el codigo del pokemon'
                ],
                'label' => 'codigo del pokemon'

            ])
            ->add('debilidades', EntityType::class, [
                'class' => Debilidad::class,
                'choice_label' => 'nombre',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('Enviar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pokemon::class,
        ]);
    }
}
