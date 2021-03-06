<?php

namespace Bigfoot\Bundle\CoreBundle\Menu;

use Bigfoot\Bundle\CoreBundle\Event\MenuEvent;
use Doctrine\ORM\EntityManager;
use Knp\Menu\MenuItem;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Security;

/**
 * Menu Builder
 */
class Builder
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var Security
     */
    protected $security;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var MenuManager
     */
    protected $menuManager;

    /**
     * Constructor
     *
     * @param EntityManager            $entityManager
     * @param Security $security
     * @param EventDispatcherInterface          $eventDispatcher
     * @param MenuManager              $menuManager
     */
    public function __construct(EntityManager $entityManager, TokenStorage $security, EventDispatcherInterface $eventDispatcher, MenuManager $menuManager)
    {
        $this->entityManager   = $entityManager;
        $this->security        = $security;
        $this->eventDispatcher = $eventDispatcher;
        $this->menuManager     = $menuManager;
    }

    /**
     * @return MenuItem
     */
    public function createMainMenu()
    {
        $builder = $this
            ->menuManager
            ->createRoot(
                'home',
                array(
                    'label' => 'Home',
                    'route' => 'admin_home',
                    'linkAttributes' => array(
                        'icon' => 'home',
                    )
                ),
                array(
                    'children-attributes' => array(
                        'class' => 'nav nav-list'
                    )
                )
            )
            ->addChild(
                'dashboard',
                array(
                    'label'          => 'Dashboard',
                    'route'          => 'admin_home',
                    'linkAttributes' => array(
                        'class' => 'dropdown-toggle',
                        'icon'  => 'dashboard',
                    ),
                )
            )
            ->addChild(
                'settings',
                array(
                    'label'          => 'Settings',
                    'url'            => '#',
                    'attributes' => array(
                        'class' => 'parent',
                    ),
                    'linkAttributes' => array(
                        'class' => 'dropdown-toggle',
                        'icon'  => 'wrench',
                    ),
                ),
                array(
                    'children-attributes' => array(
                        'class' => 'submenu parent'
                    )
                )
            );

        $this->eventDispatcher->dispatch(MenuEvent::GENERATE_MAIN, new GenericEvent($builder));
        $this->eventDispatcher->dispatch(MenuEvent::TERMINATE, new GenericEvent($builder));
        $menu = $builder->createMenu();
        $this->eventDispatcher->dispatch(MenuEvent::RENDER_MENU, new GenericEvent($menu));

        return $menu;
    }

    /**
     * Generate menu
     *
     * @param  mixed $menu
     * @param  mixed $dbMenu
     *
     * @return mixed
     */
    public function generateMenu($menu, $dbMenu)
    {
        foreach ($dbMenu->getItems() as $item) {
            $route = array(
                'label'          => $item->getName(),
                'route'          => $item->getRoute(),
                'linkAttributes' => array(
                    'class' => 'dropdown-toggle',
                    'icon'  => 'wrench',
                ),
            );

            $parameters = $item->getParameters();

            if (count($parameters)) {
                foreach ($parameters as $parameter) {
                    $route['routeParameters'][$parameter->getName()] = $parameter->getValue();
                }
            }

            $menu->addChild(
                $item->getName(),
                $route
            );
        }

        return $menu;
    }
}
