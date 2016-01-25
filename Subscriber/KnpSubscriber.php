<?php

namespace Bigfoot\Bundle\CoreBundle\Subscriber;

use Knp\Component\Pager\Event\ItemsEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class KnpSubscriber
 *
 * @package Bigfoot\Bundle\CoreBundle\Subscriber
 */
class KnpSubscriber implements EventSubscriberInterface
{
    /**
     * @var
     */
    private $requestStack;

    /**
     * @param $requestStack
     */
    public function setRequestStack($requestStack)
    {
        $this->requestStack = $requestStack->getCurrentRequest();
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            // 'knp_pager.items' => array('items', 1)
        );
    }

    /**
     * @param ItemsEvent $event
     */
    public function items(ItemsEvent $event)
    {
    }
}
