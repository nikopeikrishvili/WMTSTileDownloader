<?php

declare(strict_types=1);

namespace WMTSTileDownloader\Types;

use WMTSTileDownloader\Exceptions\InvalidLatitudeException;
use WMTSTileDownloader\Exceptions\InvalidLongitudeException;

final readonly class LatLng
{
    /**
     * @throws InvalidLatitudeException
     * @throws InvalidLongitudeException
     */
    public function __construct(private float $latitude, private float $longitude)
    {
        if($this->latitude < -90 || $this->latitude > 90){
            throw new InvalidLatitudeException('Invalid latitude '.$this->latitude.' should be between -90 and 90');
        }
        if($this->longitude < -180 || $this->longitude > 180){
            throw new InvalidLongitudeException('Invalid longitude '.$this->longitude.' should be between -180 and 180');
        }
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }
}
