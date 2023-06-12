<?php

declare(strict_types=1);

namespace WMTSTileDownloader\Types;

final readonly class Tile
{
    public function __construct(private int $x, private int $y, private ZoomLevel $z)
    {
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @return ZoomLevel
     */
    public function getZ(): ZoomLevel
    {
        return $this->z;
    }

}