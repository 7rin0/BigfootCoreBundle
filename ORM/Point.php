<?php

namespace Bigfoot\Bundle\CoreBundle\ORM;

/**
 * Point object for spatial mapping
 */
/**
 * Class Point
 *
 * @package Bigfoot\Bundle\CoreBundle\ORM
 */
class Point {
    /**
     * @var
     */
    private $latitude;
    /**
     * @var
     */
    private $longitude;

    /**
     * @param $latitude
     * @param $longitude
     */
    public function __construct($latitude, $longitude) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @param $x
     */
    public function setLatitude($x) {
        $this->latitude = $x;
    }

    /**
     * @return mixed
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * @param $y
     */
    public function setLongitude($y) {
        $this->longitude = $y;
    }

    /**
     * @return mixed
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * @return string
     */
    public function __toString() {
        //Output from this is used with POINT_STR in DQL so must be in specific format
        return sprintf('POINT(%f %f)', $this->latitude, $this->longitude);
    }
}
