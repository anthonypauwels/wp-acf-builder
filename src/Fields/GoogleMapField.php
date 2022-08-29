<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

class GoogleMapField extends AbstractField
{
    /** @var float */
    protected float $latitude = -37.81411;

    /** @var float */
    protected float $longitude = 144.96328;

    /** @var int */
    protected int $zoom = 14;

    /** @var int */
    protected int $height = 400;

    /**
     * @param float $value
     * @return $this
     */
    public function latitude(float $value): GoogleMapField
    {
        if ( $value >= -85.05112878 && $value <= 85.05112878 ) {
            $this->latitude = $value;
        }

        return $this;
    }

    /**
     * @param float $value
     * @return $this
     */
    public function longitude(float $value): GoogleMapField
    {
        if ( $value >= -180 && $value <= 180 ) {
            $this->longitude = $value;
        }

        return $this;
    }

    /**
     * @param float $lat
     * @param float $lng
     * @return $this
     */
    public function coordinates(float $lat, float $lng): GoogleMapField
    {
        return $this->latitude( $lat )->longitude( $lng );
    }

    /**
     * @param int $value
     * @return $this
     */
    public function zoom(int $value): GoogleMapField
    {
        if ( $value >= 0 && $value <= 18 ) {
            $this->zoom = $value;
        }

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function height(int $value): GoogleMapField
    {
        $this->height = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return array_merge(
            $this->genericExport('google_map'),
            [
                'center_lat' => $this->latitude,
                'cent_lng' => $this->longitude,
                'zoom' => $this->zoom,
                'height' => $this->height,
            ]
        );
    }
}