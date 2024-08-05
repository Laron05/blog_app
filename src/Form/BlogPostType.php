<?php

namespace App\Form;

use App\Entity\BlogPost;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Here we are implementing the layout of the form
 * Defining a class BlogPostType, with properties make, model, and year
 */

class BlogPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        // Instanciating parameters for title, content, created_on, updated_on fields
        $builder
            ->add('title', TextType::class,[
                'label' => 'Enter Title',
                'attr' => [
                    'placeholder' => 'Title'
                ]
            ])
            ->add('content', TextareaType::class)

            ->add('created_on', null, [
                'widget' => 'single_text',
            ])
            ->add('updated_on', null, [
                 'widget' => 'single_text',
            ])
            
            ->add('save', SubmitType::class)
       ;  
    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BlogPost::class,
        ]);
    }
}
