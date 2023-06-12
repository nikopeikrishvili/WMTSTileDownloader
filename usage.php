<?php

use WMTSTileDownloader\Downloader\BasicDownloader;
use WMTSTileDownloader\Helpers\Mercator;
use WMTSTileDownloader\Types\LatLng;
use WMTSTileDownloader\Types\ZoomLevel;
use WMTSTileDownloader\WMTSTileDownloader;

require 'vendor/autoload.php';

$downloader = new WMTSTileDownloader(mercator: new Mercator(), downloader: new BasicDownloader(saveTo: '/path/to/directory/for/storing/files'));
$nw = new LatLng(59.977005492196, -12.2607421875);
$se = new LatLng(49.610709938074, 1.93359375);
$downloader->generateFromLatLongs(northWest: $nw, southEast: $se, zoomLevel: new ZoomLevel(9));
