<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Typeclub;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormulaireClubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom') // Champ pour le nom du club
            ->add('description') // Champ pour la description du club
            ->add('date_de_creation', null, [
                'widget' => 'single_text', // Utilisation d'un seul champ pour la date
            ])
            ->add('type', EntityType::class, [
                'class' => Typeclub::class, // Entité Typeclub
                'choice_label' => 'libelle', // Affichage du libellé pour chaque option
                'label' => 'Type du Club', // Libellé du champ dans le formulaire
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Club::class, // Entité liée au formulaire
        ]);
    }
}
