<?php

namespace Bigfoot\Bundle\CoreBundle\Generator;

/**
 * Class TokenGenerator
 *
 * @package Bigfoot\Bundle\CoreBundle\Generator
 */
class TokenGenerator
{
    /**
     * @return string
     */
    public function generateToken()
    {
        return base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
    }
}
