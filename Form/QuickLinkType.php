<?php

namespace Bigfoot\Bundle\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Class QuickLinkType
 * @package Bigfoot\Bundle\CoreBundle\Form
 */
class QuickLinkType extends AbstractType
{
    private $securityContext;
    private $requestStack;

    public function __construct(RequestStack $requestStack, TokenStorage $securityContext)
    {
        $this->requestStack = $requestStack->getCurrentRequest();
        $this->securityContext = $securityContext;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->securityContext->getToken()->getUser();

        $builder
            ->add('userId',HiddenType::class,array(
                'data' => $user->getId()
            ))
            ->add('link',TextType::class,array(
                'data' => $this->requestStack->headers->get('referer')
            ))
            ->add('labelLink')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bigfoot\Bundle\CoreBundle\Entity\QuickLink'
        ));
    }
}
