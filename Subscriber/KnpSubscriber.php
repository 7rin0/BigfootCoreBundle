<?php

namespace Bigfoot\Bundle\CoreBundle\Subscriber;

use Knp\Component\Pager\Event\ItemsEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class KnpSubscriber implements EventSubscriberInterface
{
    private $requestStack;

    public function setRequestStack($requestStack)
    {
        $this->requestStack = $requestStack->getCurrentRequest();
    }

    public static function getSubscribedEvents()
    {
        return array(
            // 'knp_pager.items' => array('items', 1)
        );
    }

    public function items(ItemsEvent $event)
    {
    }
}
