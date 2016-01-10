<?php

namespace Bigfoot\Bundle\CoreBundle;

interface WidgetInterface
{
    public function __construct($container);

    public function render();
}