<?php

namespace Bigfoot\Bundle\CoreBundle\Controller;

use Doctrine\ORM\Query;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Class DashboardController
 *
 * @package Bigfoot\Bundle\CoreBundle\Controller
 */
class DashboardController
{
    use ContainerAwareTrait;

    /**
     * @return array
     */
    public function getBoard()
    {
        return array();
    }

    /**
     * @param $w1
     * @param $w2
     *
     * @return int
     */
    static function sortWidgets($w1, $w2)
    {
        if ($w1->getParam('order') == $w2->getParam('order')) {
            return 0;
        }
        return ($w1->getParam('order') < $w2->getParam('order')) ? -1 : 1;
    }
}
