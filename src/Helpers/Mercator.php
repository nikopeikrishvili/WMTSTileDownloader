<?php

declare(strict_types=1);

namespace WMTSTileDownloader\Helpers;



use WMTSTileDownloader\Exceptions\InvalidZoomLevelException;
use WMTSTileDownloader\Types\LatLng;
use WMTSTileDownloader\Types\Point;
use WMTSTileDownloader\Types\Tile;
use WMTSTileDownloader\Types\ZoomLevel;

readonly class Mercator implements MercatorInterface
{
    public function __construct(private int $tileSize = 256 )
    {
    }

    /**
     * Generate point from Lat/Lng
     * @param LatLng $latLng
     * @return Point
     */
    public function fromLatLngToPoint(LatLng $latLng): Point
    {
        $sinY = min(
            max(
                sin($latLng->getLatitude() * (pi() / 180)),
                -.9999
            ),
            .9999
        );
        $x = 128 + $latLng->getLongitude() * ($this->tileSize / 360);
        $y = 128 + 0.5 * log((1 + $sinY) / (1 - $sinY)) * -($this->tileSize / (2 * pi()));

        return new Point(x: $x, y: $y);
    }

    /**
     * Get tile from LatLng
     *
     * @param LatLng $latLng
     * @param int $zoom
     * @return Tile
     * @throws InvalidZoomLevelException
     */
    public function tileAtLatLng(LatLng $latLng, int $zoom): Tile
    {
        $t = pow(2, $zoom);
        $s = $this->tileSize / $t;
        $point = $this->fromLatLngToPoint($latLng);
        $x = intval(floor($point->getX() / $s));
        $y = intval(floor($point->getY() / $s));
        return new Tile(x: $x, y: $y, z: new ZoomLevel($zoom));
    }
}