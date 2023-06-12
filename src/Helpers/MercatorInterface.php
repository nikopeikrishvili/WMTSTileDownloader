<?php

namespace WMTSTileDownloader\Helpers;

use WMTSTileDownloader\Exceptions\InvalidLatitudeException;
use WMTSTileDownloader\Exceptions\InvalidLongitudeException;
use WMTSTileDownloader\Exceptions\InvalidZoomLevelException;
use WMTSTileDownloader\Types\Bounds;
use WMTSTileDownloader\Types\LatLng;
use WMTSTileDownloader\Types\Point;
use WMTSTileDownloader\Types\Tile;

interface MercatorInterface
{
    /**
     * Generate point from Lat/Lng
     * @param LatLng $latLng
     * @return Point
     */
    public function fromLatLngToPoint(LatLng $latLng): Point;

    /**
     * Get tile from LatLng
     *
     * @param LatLng $latLng
     * @param int $zoom
     * @return Tile
     * @throws InvalidZoomLevelException
     */
    public function tileAtLatLng(LatLng $latLng, int $zoom): Tile;

}