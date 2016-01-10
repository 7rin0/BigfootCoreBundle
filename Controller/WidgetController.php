<?php

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