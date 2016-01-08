<?php

namespace Bigfoot\Bundle\CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * QuickLink Controller
 * @Route("/csv")
 */
class CsvController extends Controller
{
    /**
     * Generate Widget
     *
     * @Route("/generate/{entity}/{fields}", name="admin_csv_generate")
     */
    public function generateAction($entity, $fields)
    {
        $entity   = base64_decode($entity);
        $fields   = unserialize(base64_decode($fields));
        $csvArray = $this->get('bigfoot_core.manager.csv')->generateCsv($entity, $fields);

        return $csvArray;
    }
}
