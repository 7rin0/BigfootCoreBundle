<?php

namespace Bigfoot\Bundle\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

/**
 * Tag controller.
 *
 * @Cache(maxage="0", smaxage="0", public="false")
 * @Route("/tag")
 */
class TagController extends CrudController
{
    /**
     * @return string
     */
    protected function getName()
    {
        return 'admin_tag';
    }

    /**
     * @return string
     */
    protected function getEntity()
    {
        return 'BigfootCoreBundle:Tag';
    }

    protected function getFields()
    {
        return array(
            'id',
            'name',
        );
    }

    protected function getEntityLabelPlural()
    {
        return 'bigfoot_core.controller.admin_tag.entity.label_plural';
    }

    /**
     * Lists all Tag entities.
     *
     * @Route("/", name="admin_tag")
     * @Method("GET")
     */
    public function indexAction()
    {

        return $this->doIndex();
    }

    /**
     * Displays a form to create a new Tag entity.
     *
     * @Route("/new", name="admin_tag_new")
     */
    public function newAction(RequestStack $requestStack)
    {
        return $this->doNew($requestStack->getCurrentRequest());
    }

    /**
     * Displays a form to edit an existing Tag entity.
     *
     * @Route("/{id}/edit", name="admin_tag_edit")
     */
    public function editAction(RequestStack $requestStack, $id)
    {
        return $this->doEdit($requestStack->getCurrentRequest(), $id);
    }

    /**
     * Deletes a Tag entity.
     *
     * @Route("/{id}/delete", name="admin_tag_delete")
     * @Method("GET|DELETE")
     */
    public function deleteAction(RequestStack $requestStack, $id)
    {
        return $this->doDelete($requestStack->getCurrentRequest(), $id);
    }

    /**
     * @Route("/get", name="admin_tag_get")
     */
    function getAction()
    {
        $em = $this->container->get('doctrine')->getManager();

        $tagRepository = $em->getRepository('BigfootCoreBundle:Tag');
        $tagsToJson = array();
        foreach ($tagRepository->findAll() as $tag) {
            $tagsToJson[] = $tag->getName();
        }

        return new Response(json_encode($tagsToJson), 200, array('Content-Type', 'application/json'));
    }
}
