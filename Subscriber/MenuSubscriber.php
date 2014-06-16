<?php

namespace Bigfoot\Bundle\CoreBundle\Subscriber;

use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Doctrine\ORM\EntityManager;

use Bigfoot\Bundle\CoreBundle\Event\MenuEvent;

/**
 * Menu Subscriber
 */
class MenuSubscriber implements EventSubscriberInterface
{
    /**
     * @var \Symfony\Component\Security\Core\SecurityContextInterface
     */
    private $security;

    /**
     * @param SecurityContextInterface $security
     */
    public function __construct(SecurityContextInterface $security)
    {
        $this->security = $security;
    }

    /**
     * Get subscribed events
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            MenuEvent::GENERATE_MAIN => array('onGenerateMain', 6)
        );
    }

    /**
     * @param GenericEvent $event
     */
    public function onGenerateMain(GenericEvent $event)
    {
        $builder = $event->getSubject();

        if (!$builder->childExists('structure')) {
            $builder
                ->addChild(
                    'structure',
                    array(
                        'label'          => 'Structure',
                        'url'            => '#',
                        'linkAttributes' => array(
                            'class' => 'dropdown-toggle',
                            'icon'  => 'building',
                        )
                    ),
                    array(
                        'children-attributes' => array(
                            'class' => 'submenu'
                        )
                    )
                );
        }

        $builder
            ->addChildFor(
                'structure',
                'structure_tag',
                array(
                    'label'          => 'Tag',
                    'url'            => '#',
                    'linkAttributes' => array(
                        'class' => 'dropdown-toggle',
                        'icon'  => 'tag',
                    )
                ),
                array(
                    'children-attributes' => array(
                        'class' => 'submenu'
                    )
                )
            )
            ->addChildFor(
                'structure_tag',
                'structure_tag_category',
                array(
                    'label'  => 'Category',
                    'route'  => 'admin_tag_category',
                    'extras' => array(
                        'routes' => array(
                            'admin_tag_category_new',
                            'admin_tag_category_edit'
                        )
                    ),
                    'linkAttributes' => array(
                        'icon' => 'double-angle-right',
                    )
                )
            )
            ->addChildFor(
                'structure_tag',
                'structure_tag_tag',
                array(
                    'label'  => 'Tag',
                    'route'  => 'admin_tag',
                    'extras' => array(
                        'routes' => array(
                            'admin_tag_new',
                            'admin_tag_edit'
                        )
                    ),
                    'linkAttributes' => array(
                        'icon' => 'double-angle-right',
                    )
                )
            );
    }
}
