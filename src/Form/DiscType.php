<?php

namespace App\Form;

use App\Entity\Disc;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
class DiscType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('discTitle',
                TextType::class, [
                    'label' => 'Title',
                    'attr' => [
                        'placeholder' => 'Title',
                    ],
                    'constraints' => [
                        new Regex([
                            'pattern' => '/^[A-Za-zéèàçâêûîôäëüïö\_\-\s]+$/',
                            'message' => 'Caratère(s) non valide(s)'
                        ]),
                        'help' => 'Vous devez rentrer le titre ici',
                    ]]
            )
            ->add('discYear'
            )
            ->add('discPicture',
                FileType::class, [
                    'label' => 'Photo'
                    ]
            )
            ->add('discLabel'
            )
            ->add('discGenre'
            )
            ->add('discPrice'
            )
            ->add('artist'
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Disc::class,
        ]);
    }
}
