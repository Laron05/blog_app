<?php

namespace App\Form;

use App\Entity\BlogPost;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BlogPostType extends AbstractType
{
    /**
     * Build the form with the necessary fields.
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array $options The options for this form
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Adding the title field with a custom label and placeholder
        $builder
            ->add('title', TextType::class, [
                'label' => 'Enter Title',
                'attr' => [
                    'placeholder' => 'Title'
                ]
            ])
            // Adding the content field as a textarea
            ->add('content', TextareaType::class)

            // Adding the created_on field with a single text widget
            ->add('created_on', null, [
                'widget' => 'single_text',
            ])

            // Adding the updated_on field with a single text widget
            ->add('updated_on', null, [
                'widget' => 'single_text',
            ])

            // Adding the save button
            ->add('save', SubmitType::class);
    }

    /**
     * Configure the options for this form.
     *
     * @param OptionsResolver $resolver The resolver for the options
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        // Setting the data class to BlogPost
        $resolver->setDefaults([
            'data_class' => BlogPost::class,
        ]);
    }
}
