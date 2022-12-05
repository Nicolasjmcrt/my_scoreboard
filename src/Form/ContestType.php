<?php

namespace App\Form;

use App\Entity\Contest;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('game', EntityType::class, [
                'class' => 'App\Entity\Game',
                'choice_label' => 'game.title',
            ])
            ->add('start_date', DateType::class)
            ->add('winner_id', EntityType::class, [
                'class' => 'App\Entity\Player',
                'choice_label' => 'player.nickname',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contest::class,
        ]);
    }
}
