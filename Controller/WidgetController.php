<?php
/**
 * Created by PhpStorm.
 * User: splancon
 * Date: 21/01/14
 * Time: 12:31
 */

namespace Bigfoot\Bundle\CoreBundle\Controller;

class WidgetController extends CrudController
{

    public function getBlockPrefix()
    {
        return "admin_widget_backoffice";
    }

    public function getFields()
    {
        return array();
    }

    public function getEntity()
    {
        return "BigfootCoreBundle:Widget";
    }
}