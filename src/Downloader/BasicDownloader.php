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