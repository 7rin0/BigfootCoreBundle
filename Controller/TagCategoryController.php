<?php

namespace Bigfoot\Bundle\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * TagCategory controller.
 *
 * @Cache(maxage="0", smaxage="0", public="false")
 * @Route("/tag/category")
 */
class TagCategoryController extends CrudController
{
    /**
     * @return string
     */
    protected function getName()
    {
        return 'admin_tag_category';
    }

    /**
     * @return string
     */
    protected function getEntity()
    {
        return 'BigfootCoreBundle:TagCategory';
    }

    /**
     * @return array
     */
    protected function getFields()
    {
        return array(
            'id',
            'name',
        );
    }

    /**
     * @return string
     */
    public function getEntityLabel()
    {
        return 'bigfoot_core.controller.admin_tag_category.entity.label';
    }

    /**
     * @return string
     */
    protected function getEntityLabelPlural()
    {
        return 'bigfoot_core.controller.admin_tag_category.entity.label_plural';
    }

    /**
     * Lists all TagCategory entities.
     *
     * @Route("/", name="admin_tag_category")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->doIndex();
    }

    /**
     * Displays a form to create a new TagCategory entity.
     *
     * @Route("/new", name="admin_tag_category_new")
     */
    public function newAction()
    {
        return $this->doNew();
    }

    /**
     * Displays a form to edit an existing TagCategory entity.
     *
     * @Route("/{id}/edit", name="admin_tag_category_edit")
     */
    public function editAction($id)
    {
        return $this->doEdit($id);
    }

    /**
     * Deletes a TagCategory entity.
     *
     * @Route("/{id}/delete", name="admin_tag_category_delete")
     * @Method("GET|DELETE")
     */
    public function deleteAction($id)
    {
        return $this->doDelete($id);
    }
}
