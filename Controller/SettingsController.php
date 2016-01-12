<?php

namespace Bigfoot\Bundle\CoreBundle\Controller;

use Bigfoot\Bundle\CoreBundle\Entity\Settings;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

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
     * @param RequestStack $requestStack
     *
     * @Route("/global", name="admin_settings_global")
     * @Template("BigfootCoreBundle:settings:form.html.twig")
     * @method({"GET", "POST"})
     *
     * @return array
     */
    public function globalAction(RequestStack $requestStack)
    {
        $settings = $this->getRepository('BigfootCoreBundle:Settings')->findAll();
        $settings = !empty($settings) ? current($settings) : null;

        $form = $this->createForm(
            $this->get('bigfoot_core.form.type.settings'),
            !empty($settings) ? $settings->getSettings() : null
        );

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

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
