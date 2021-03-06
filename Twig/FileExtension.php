<?php

namespace Bigfoot\Bundle\CoreBundle\Twig;

use Bigfoot\Bundle\CoreBundle\Manager\FileManager;
use Twig_Extension;

/**
 * Class FileExtension
 * @package Bigfoot\Bundle\CoreBundle\Twig
 */
class FileExtension extends Twig_Extension
{
    /** @var FileManager */
    private $fileManager;

    /**
     * @param Loader $formattersLoader
     */
    public function __construct($fileManager)
    {
        $this->fileManager = $fileManager;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('bigfoot_file', array($this, 'bigfootFile'))
        );
    }

    /**
     * @param      $entity
     * @param      $filePathField
     * @param bool $absolute
     *
     * @return string
     * @throws \Exception
     */
    public function bigfootFile($entity, $filePathField, $absolute = false)
    {
        if ($absolute === true) {
            return $this->fileManager->getFileAbsolutePath($entity, $filePathField);
        } else {
            return $this->fileManager->getFilePath($entity, $filePathField);
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bigfoot_file_filter';
    }
}
