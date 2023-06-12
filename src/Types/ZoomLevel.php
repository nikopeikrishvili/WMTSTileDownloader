<?php

declare(strict_types=1);

namespace WMTSTileDownloader\Types;

use WMTSTileDownloader\Exceptions\InvalidZoomLevelException;

final readonly class ZoomLevel
{
    /**
     * @throws InvalidZoomLevelException
     */
    public function __construct(private int $level)
    {
        if($this->level < 1 || $this->level > 23){
            throw new InvalidZoomLevelException('Invalid zoom level provided, should be between 1 and 23');
        }
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }


}