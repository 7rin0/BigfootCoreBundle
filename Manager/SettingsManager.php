<?php

namespace Bigfoot\Bundle\CoreBundle\Manager;

use Doctrine\ORM\EntityManager;

/**
 * Settings manager
 */
class SettingsManager
{
    /**
     * @var Settings
     */
    private $settings;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $settings = $em->getRepository('BigfootCoreBundle:Settings')->findAll();

        $this->settings = current($settings);
    }

    /**
     * Get settings
     *
     * @param  string $name
     * @param  mixed $default
     * @return mixed
     */
    public function getSetting($name, $default = null)
    {
        if (!$this->settings) {
            return null;
        }

        return $this->settings->getSetting($name, $default);
    }
}
