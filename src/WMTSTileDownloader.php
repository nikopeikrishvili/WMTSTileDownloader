<?php

declare(strict_types=1);

namespace WMTSTileDownloader;

use App\Models\MobileProvidersList;
use App\Models\ProviderTiles;
use WMTSTileDownloader\Downloader\DownloaderInterface;
use WMTSTileDownloader\Exceptions\InvalidZoomLevelException;
use WMTSTileDownloader\Helpers\MercatorInterface;
use WMTSTileDownloader\Types\LatLng;
use WMTSTileDownloader\Types\ZoomLevel;

readonly class WMTSTileDownloader
{
    public function __construct(private MercatorInterface $mercator, private DownloaderInterface $downloader)
    {
    }

    /**
     * @param LatLng $northWest
     * @param LatLng $southEast
     * @param ZoomLevel $zoomLevel
     * @return true
     * @throws InvalidZoomLevelException
     */
    public function generateFromLatLongs(LatLng $northWest, LatLng $southEast, ZoomLevel $zoomLevel): true
    {
        $tile1 = $this->mercator->tileAtLatLng($northWest, $zoomLevel->getLevel());
        $tile2 = $this->mercator->tileAtLatLng($southEast, $zoomLevel->getLevel());
        $xTile1 = $tile1->getX();

        $xTile2 = $tile2->getX();
        $yTile1 = $tile1->getY();
        $yTile2 = $tile2->getY();
        $this->generate(xTile1: $xTile1,xTile2: $xTile2,yTile1: $yTile1,yTile2: $yTile2,zoomLevel: $zoomLevel->getLevel());
        return true;
    }

    /**
     * @param int $xTile1
     * @param int $xTile2
     * @param int $yTile1
     * @param int $yTile2
     * @param int $zoomLevel
     * @return void
     */
    private function generate(
        int $xTile1,
        int $xTile2,
        int $yTile1,
        int $yTile2,
        int $zoomLevel
    ): void {
        $i = 0;
        for ($xTile = $xTile1; $xTile <= $xTile2 + 1; $xTile++) {
            for ($yTile = $yTile1; $yTile <= $yTile2 + 1; $yTile++) {
                $i++;
                $this->downloader->download(x: $xTile,y: $yTile, z: $zoomLevel,counter: $i);
            }
        }

    }
}