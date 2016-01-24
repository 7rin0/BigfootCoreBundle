<?php

namespace Bigfoot\Bundle\CoreBundle\ORM;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Mapping type for spatial POINT objects
 */
class PointType extends Type
{
    /**
     *
     */
    const POINT = 'point';

    /**
     * Gets the name of this type.
     *
     * @return string
     */
    public function getName() {
        return self::POINT;
    }

    /**
     * @param array            $fieldDeclaration
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {
        return 'POINT';
    }

    /**
     * @param mixed            $value
     * @param AbstractPlatform $platform
     *
     * @return Point|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform) {
        //Null fields come in as empty strings
        if($value == '') {
            return null;
        }

        $data = unpack('x/x/x/x/corder/Ltype/dlat/dlon', $value);
        return new Point($data['lat'], $data['lon']);
    }

    /**
     * @param mixed            $value
     * @param AbstractPlatform $platform
     *
     * @return string|void
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform) {
        if (!$value) return;

        return pack('xxxxcLdd', '0', 1, $value->getLatitude(), $value->getLongitude());
    }
}
