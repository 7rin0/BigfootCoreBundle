<?php

namespace Bigfoot\Bundle\CoreBundle\Twig;

use Twig_Extension;
use Twig_Extension_GlobalsInterface;

/**
 * Class LocalesFlagsExtension
 *
 * @package Bigfoot\Bundle\CoreBundle\Twig
 */
class LocalesFlagsExtension extends Twig_Extension implements Twig_Extension_GlobalsInterface
{
    /** @var \Twig_Environment */
    protected $twig;

    /** @var array */
    protected $locales;

    /**
     * @param $locales
     */
    public function __construct($locales, \Twig_Environment $environment)
    {
        $this->locales = $locales;
        $this->twig = $environment;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        $options = array(
            'is_safe' => array('html'),
            'needs_environment' => true,
        );
        return array(
            new \Twig_SimpleFunction('bigfoot_locale_flags', array($this, 'localeFlags', $options))
        );
    }

    /**
     * @return array
     */
    public function localeFlags()
    {
        $locales = array();

        foreach ($this->locales as $key => $config) {
            $locale = array(
                'label' => $config['label'],
            );

            if (isset($config['parameters']['flag'])) {
                $locale['flag'] = $this->asset($config['parameters']['flag']);
            } else {
                $locale['flag'] = $this->asset(sprintf('bundles/bigfootcore/img/flags/%s.gif', $key));
            }

            $locales[$key] = $locale;
        }

        return json_encode($locales);
    }

    /**
     * @param $asset
     *
     * @return mixed
     */
    protected function asset($asset)
    {
        return call_user_func($this->twig->getFunction('asset')->getCallable(), $asset);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'locales_flags';
    }
}