<?php

namespace Bigfoot\Bundle\CoreBundle\Controller;

/**
 * Class WidgetController
 *
 * @package Bigfoot\Bundle\CoreBundle\Controller
 */
class WidgetController extends CrudController
{
    /**
     * @return string
     */
    public function getName()
    {
        return "admin_widget_backoffice";
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return array();
    }

    /**
     * @return string
     */
    public function getEntity()
    {
        return "BigfootCoreBundle:Widget";
    }
}
