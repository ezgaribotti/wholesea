<?php

namespace Modules\Shipments\src\Utils;

class HaversineUtil
{
    public static function calculateDistance(object $origin, object $destination): float
    {
        $earthRadius = 6371;

        $deltaLatitude = deg2rad($destination->latitude - $origin->latitude);
        $deltaLongitude = deg2rad($destination->longitude - $origin->longitude);

        $intermediate = sin($deltaLatitude / 2) ** 2 + cos(deg2rad($origin->latitude))
            * cos(deg2rad($destination->latitude)) * sin($deltaLongitude / 2) ** 2;

        $centralAngle = 2 * asin(sqrt($intermediate));
        return $earthRadius * $centralAngle;
    }
}
