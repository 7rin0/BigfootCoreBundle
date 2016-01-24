<?php

namespace Bigfoot\Bundle\CoreBundle;

/**
 * Interface WidgetInterface
 *
 * @package Bigfoot\Bundle\CoreBundle
 */
interface WidgetInterface
{
    /**
     * @param $container
     */
    public function __construct($container);

    /**
     * @return mixed
     */
    public function render();
}