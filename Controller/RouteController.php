<?php

namespace Bigfoot\Bundle\CoreBundle\Controller;

use Bigfoot\Bundle\CoreBundle\Form\RouteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Route controller.
 *
 * @Cache(maxage="0", smaxage="0", public="false")
 * @Route("/route_manager")
 */
class RouteController extends CrudController
{
    /**
     * @return string
     */
    protected function getName()
    {
        return 'bigfoot_route';
    }

    /**
     * @return string
     */
    protected function getEntity()
    {
        return 'BigfootCoreBundle:Route';
    }

    /**
     * @return array
     */
    protected function getFields()
    {
        return array(
            'id'   => array(
                'label' => 'ID',
            ),
            'url'   => array(
                'label' => 'Url',
            ),
            'type' => array(
                'label' => 'Type',
            )
        );
    }

    /**
     * @return mixed
     */
    protected function getFormType()
    {
        return RouteType::class;
    }

    /**
     * Lists Route entities.
     *
     * @Route("/", name="bigfoot_route")
     */
    public function indexAction()
    {
        return $this->doIndex();
    }

    /**
     * New Route entity.
     *
     * @Route("/new", name="bigfoot_route_new")
     */
    public function newAction()
    {
        return $this->doNew();
    }

    /**
     * Edit Route entity.
     *
     * @Route("/edit/{id}", name="bigfoot_route_edit")
     */
    public function editAction($id)
    {
        return $this->doEdit($id);
    }

    /**
     * Delete Route entity.
     *
     * @Route("/delete/{id}", name="bigfoot_route_delete")
     */
    public function deleteAction($id)
    {
        return $this->doDelete($id);
    }
}
