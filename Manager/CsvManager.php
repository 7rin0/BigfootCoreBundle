<?php

namespace Bigfoot\Bundle\CoreBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;

/**
 * Csv manager
 */
class CsvManager
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $entity
     * @param $fields
     * @return Response
     */
    public function generateCsv($entity, $fields)
    {
        $labelArray         = array('ID');
        $entitySelections   = array();
        $externalSelections = array();

        foreach ($fields as $dbField => $options) {
            $labelArray[] = $options['label'];

            if (strpos($dbField, '.')) {
                $externalSelections[] = array(
                    'field'    => $dbField,
                    'multiple' => isset($options['multiple']) ? $options['multiple'] : false,
                );

            } else {
                $entitySelections[] = $dbField;
            }
        }

        $handle = fopen('php://memory', 'r+');

        fputcsv($handle, $labelArray);

        $csvQueryArray = $this->buildCsvQuery($entity, $entitySelections, $externalSelections);

        foreach ($csvQueryArray as $csvElement) {
            fputcsv($handle, $csvElement);
        }

        rewind($handle);

        $content = stream_get_contents($handle);

        fclose($handle);

        return new Response($content, 200, array(
            'Content-Type'        => 'application/force-download',
            'Content-Disposition' => 'attachment; filename="export.csv"'
        ));
    }

    /**
     * @param $entity
     * @param $entitySelections
     * @param $externalSelections
     *
     * @return array
     */
    private function buildCsvQuery($entity, $entitySelections, $externalSelections)
    {
        $query = $this->entityManager->getRepository($entity)
            ->createQueryBuilder('e')
            ->select('e.id');

        foreach ($entitySelections as $entitySelection) {
            $query = $query
                ->addSelect('e.' . $entitySelection);
        }

        foreach ($externalSelections as $externalSelection) {
            $externalTempArray = explode('.', $externalSelection['field']);
            $externalEntity    = $externalTempArray[0];
            $externalField     = $externalTempArray[1];
            $entityPrefix      = substr($externalEntity, 0, 1);
            $alias             = ($externalSelection['multiple']) ? $entityPrefix . ucfirst($externalField) . 'XXX' : $entityPrefix . ucfirst($externalField);

            $query = $query
                ->addSelect($entityPrefix . '.' . $externalField . ' as ' . $alias)
                ->leftJoin('e.' . $externalEntity, $entityPrefix);
        }

        $csvArray = $query->getQuery()->getResult();

        return $this->mergeClonedItem($csvArray);
    }

    /**
     * @param        $csvArray
     * @param string $separator
     *
     * @return array
     */
    private function mergeClonedItem($csvArray, $separator = ',')
    {
        $finalArray = array();

        foreach ($csvArray as $key => $element) {
            foreach ($element as $keyE => $value) {
                $value = $this->formatValue($value);

                if (strpos($keyE, 'XXX')) {
                    $finalArray[$element['id']][$keyE] = isset($finalArray[$element['id']][$keyE]) ? ($finalArray[$element['id']][$keyE] . ' ' . $separator . $value) : $value;
                } else {
                    $finalArray[$element['id']][$keyE] = $value;
                }
            }
        }

        return $finalArray;
    }

    /**
     * @param $value
     *
     * @return string
     */
    private function formatValue($value)
    {
        if ($value instanceof \DateTime) {
            return $value->format('d-m-Y');
        }

        return $value;
    }
}
