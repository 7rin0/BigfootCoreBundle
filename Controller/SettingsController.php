<?php

namespace Bigfoot\Bundle\CoreBundle\Controller;

use Bigfoot\Bundle\CoreBundle\Entity\Settings;
use Bigfoot\Bundle\CoreBundle\Form\Type\SettingsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Settings Controller.
 *
 * @Cache(maxage="0", smaxage="0", public="false")
 * @Route("/settings")
 *
 * @package BigfootCoreController
 */
class SettingsController extends BaseController
{
    /**
     * Globale settings action
     *
     * @Route("/global", name="admin_settings_global")
     * @Template("BigfootCoreBundle:settings:form.html.twig")
     * @method({"GET", "POST"})
     *
     * @return array
     */
    public function globalAction()
    {
        $settings = $this->getRepository('BigfootCoreBundle:Settings')->findAll();
        $settings = !empty($settings) ? current($settings) : null;
        $form = $this->createForm(
            SettingsType::class,
            !empty($settings) ? $settings->getSettings() : null
        );

        if ($this->getRequestStack()->isMethod('POST')) {
            $form->handleRequest($this->getRequestStack());

            $datas = $form->getData();

            $settings = !empty($settings) ? $settings : new Settings();
            $settings->setSettings($datas);

            $this->persistAndFlush($settings);
        }

        return array(
            'form' => $form->createView()
        );
    }
}
