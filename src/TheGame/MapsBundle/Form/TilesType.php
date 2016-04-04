<?php

namespace TheGame\MapsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TilesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mapId', null, array('label' => 'Map Id',
                'label_attr' => array('class' => 'UYBGFont_1em UYBGLJustify UYBGFont_Bold', 'style' => 'margin-right: 95px;'),
                'attr' => array('class' => 'UYBGListBorder UYBGFont_075em', 'style' => 'width: 30%;')))
            ->add('tileColRow', null, array('label' => 'Column and Row',
                'label_attr' => array('class' => 'UYBGFont_1em UYBGLJustify UYBGFont_Bold', 'style' => 'margin-right: 2px;'),
                'attr' => array('class' => 'UYBGListBorder UYBGFont_075em')))
            ->add('tileSectorName', null, array('label' => 'Sector Name',
                'label_attr' => array('class' => 'UYBGFont_1em UYBGLJustify UYBGFont_Bold', 'style' => 'margin-right: 35px;'),
                'attr' => array('class' => 'UYBGListBorder UYBGFont_075em')))
            ->add('tilePlayable', null, array('label' => 'Playable',
                'label_attr' => array('class' => 'UYBGFont_1em UYBGLJustify UYBGFont_Bold', 'style' => 'margin-right: 73px;'),
                'attr' => array('class' => 'UYBGListBorder UYBGFont_075em')))
            ->add('tileData', null, array('label' => 'Tile JSON',
                'label_attr' => array('class' => 'UYBGFont_1em UYBGLJustify UYBGFont_Bold',
                    'style' => 'margin-right: 63px;'),
                'attr' => array('class' => 'UYBGListBorder UYBGFont_075em', 'style' => 'width: 30%; height: 75px; margin-top: 2px;')));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TheGame\MapsBundle\Entity\Tiles'
        ));
    }
}
