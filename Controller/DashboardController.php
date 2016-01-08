<?php

namespace Bigfoot\Bundle\CoreBundle\Controller;

use Doctrine\ORM\Query;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class DashboardController
{
    use ContainerAwareTrait;

    public function getBoard()
    {
        return array();
    }

    static function sortWidgets($w1, $w2)
    {
        if ($w1->getParam('order') == $w2->getParam('order')) {
            return 0;
        }
        return ($w1->getParam('order') < $w2->getParam('order')) ? -1 : 1;
    }
}