<?php

namespace WMTSTileDownloader\Downloader;

interface DownloaderInterface
{
    public function download(int $x, int $y, int $z, int $counter):bool;
}