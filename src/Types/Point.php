<?php

declare(strict_types=1);

namespace WMTSTileDownloader\Types;

final readonly class Point
{
    public function __construct(private  float $x, private  float $y)
    {
    }

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }


}