<?php

namespace GrillBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GrillerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->isAddPhotoForm = $options['is_add_photo_form'];
//        if (!$this->isAddPhotoForm)
//        {
        $builder->add('name')
        ->add('email')
        ->add('photo',FileType::class, array('data_class' => null))
        ->add('description')
        ->add('save', SubmitType::class, array('label' => 'Save griller'));
//        }
//        else
//        {
//        $builder->add('images',FileType::class, array('data_class' => null))
//        ->add('save', SubmitType::class, array('label' => 'AddPhoto'));
//        }
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GrillBundle\Entity\Griller'            
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'grillbundle_griller';
    }


}
