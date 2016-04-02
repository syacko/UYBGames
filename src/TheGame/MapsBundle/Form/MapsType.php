<?php

namespace TheGame\MapsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MapsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mapName', null, array('label' => 'Name',
                'label_attr' => array('class' => 'UYBGFont_1em UYBGLJustify UYBGFont_Bold', 'style' => 'margin-right: 47px;'),
                'attr' => array('class' => 'UYBGListBorder UYBGFont_075em', 'style' => 'width: 30%;')))
            ->add('mapPlayable', null, array('label' => 'Playable',
                'label_attr' => array('class' => 'UYBGFont_1em UYBGLJustify UYBGFont_Bold', 'style' => 'margin-right: 17px;'),
                'attr' => array('class' => 'UYBGListBorder UYBGFont_075em')))
            ->add('mapImageUrl', null, array('label' => 'Image URL',
                'label_attr' => array('class' => 'UYBGFont_1em UYBGLJustify UYBGFont_Bold', 'style' => 'margin-right: 2px;'),
                'attr' => array('class' => 'UYBGListBorder UYBGFont_075em', 'style' => 'width: 30%; margin-top: 2px;')))
            ->add('mapTileData', null, array('label' => 'Tile JSON',
                'label_attr' => array('class' => 'UYBGFont_1em UYBGLJustify UYBGFont_Bold',
                    'style' => 'margin-right: 8px;'),
                'attr' => array('class' => 'UYBGListBorder UYBGFont_075em', 'style' => 'width: 30%; height: 75px; margin-top: 2px;')));
    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TheGame\MapsBundle\Entity\Maps'
        ));
    }
}
