<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                // 'download_label' => '...',
                'download_uri' => false,
                // 'image_uri' => true,
                'imagine_pattern' => 'squared_thumbnail_medium',
                'asset_helper' => true,
            ])
            ->add('medias', CollectionType::class, [
                'entry_type' => MediaType::class,
                'entry_options' => [
                    'label' => false,
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
