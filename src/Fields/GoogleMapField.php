<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;

/**
 * Class GoogleMapField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
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
     * @param string $api_key
     * @param string $client_id
     * @return $this
     */
    public function api(string $api_key, string $client_id = ''): GoogleMapField
    {
        add_filter('acf/fields/google_map/api', function ( $args ) use ( $api_key, $client_id ) {
            $args['key'] = $api_key;
            $args['client'] = $client_id;

            return $args;
        } );

        return $this;
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return $this->export( Builder::googleMap, [
            'center_lat' => $this->latitude,
            'cent_lng' => $this->longitude,
            'zoom' => $this->zoom,
            'height' => $this->height,
        ] );
    }
}