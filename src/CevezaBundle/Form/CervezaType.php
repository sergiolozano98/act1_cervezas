<?php

namespace CevezaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CervezaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', TextType::class)
        ->add('pais', TextType::class)
        ->add('poblacion' ,TextType::class)
        ->add('tipo', TextType::class )
        ->add('importacion', TextType::class)
        ->add('tamano', IntegerType::class)
        ->add('fechaAlmacen', DateType::class)
        ->add('cantidad', IntegerType::class)
        ->add('foto')
        ->add('guardar',SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CevezaBundle\Entity\Cerveza'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cevezabundle_cerveza';
    }


}
