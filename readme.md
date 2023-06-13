# Description
This library provides very basic functionality for downloading Tile layers from a WMTS server. Your goal is to implement the [DownloaderInterface](src/Downloader/DownloaderInterface.php) with you logic
with your logic and pass it to the  [WMTSTileDownloader](src/WMTSTileDownloader.php) class constructor when creating an object from it.

Data about the tile will be passed to the download method, and then you decide what to do.
```php
int $x, int $y, int $z, int $counter
```

## Example
```php
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
```

The library comes with an example [BasicDownloader](src/Downloader/BasicDownloader.php)
```php
<?php

declare(strict_types=1);

namespace WMTSTileDownloader\Downloader;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

final readonly class BasicDownloader implements DownloaderInterface
{

    public function __construct(private string $saveTo)
    {
    }

    /**
     * @throws GuzzleException
     */
    public function download(int $x, int $y, int $z, int $counter): bool
    {
        $url = 'https://tile.openstreetmap.org/'.$z.'/'.$x.'/'.$y.'.png';
        $this->downloadFile($url,$z.'_'.$x.'_'.$y,'.png');
        return true;
    }

    /**
     * @throws GuzzleException
     */
    public function downloadFile(string $url, string $name, string $extensions): void
    {
        $path = rtrim($this->saveTo,'/').'/' . $name . $extensions;
        $client = new Client();
        $client->get($url, ['sink' => $path]);
    }
}
```
class that implements the [DownloaderInterface](src/Downloader/DownloaderInterface.php)
It is just for example purposes, but in many cases, it may be the only thing that you need: just download tiles in a folder.