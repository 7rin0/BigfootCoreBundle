<?php

namespace Bigfoot\Bundle\CoreBundle\Translation;

use Bigfoot\Bundle\CoreBundle\Entity\TranslatableLabel;
use Bigfoot\Bundle\CoreBundle\Entity\TranslatableLabelRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Translation\Loader\LoaderInterface;
use Symfony\Component\Translation\MessageCatalogue;

/**
 * Class DatabaseLoader
 *
 * @package Bigfoot\Bundle\CoreBundle\Translation
 */
class DatabaseLoader implements LoaderInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param mixed  $resource
     * @param string $locale
     * @param string $domain
     *
     * @return null|MessageCatalogue
     */
    public function load($resource, $locale, $domain = 'messages')
    {
        $catalogue = null;
        $catalogue = new MessageCatalogue($locale);

        /** @var TranslatableLabelRepository $repository */
        $repository = $this->entityManager->getRepository('BigfootCoreBundle:TranslatableLabel');
        $translatableLabels = $repository->findAllForLocaleAndDomain($locale, $domain);

        if ($translatableLabels) {
            /** @var TranslatableLabel $translatableLabel */
            foreach ($translatableLabels as $translatableLabel) {
                $catalogue->set($translatableLabel['name'], $translatableLabel['value'], $domain);
            }
        }

        return $catalogue;
    }
}
