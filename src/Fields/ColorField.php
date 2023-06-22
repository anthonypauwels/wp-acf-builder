<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;

/**
 * Class ColorField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class ColorField extends AbstractField
{
    /** @var bool */
    protected bool $enableOpacity = false;

        /** @var string */
    protected string $format = 'string';

    /**
     * @param bool $value
     * @return $this
     */
    public function enableOpacity(bool $value = true): ColorField
    {
        $this->enableOpacity = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function disableOpacity(): ColorField
    {
        return $this->enableOpacity( false );
    }

    /**
     * @param string $value
     * @return $this
     */
    public function return(string $value): ColorField
    {
        if ( in_array( $value, ['array', 'string'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function returnArray(): ColorField
    {
        return $this->return('array');
    }

    /**
     * @return $this
     */
    public function returnString(): ColorField
    {
        return $this->return('string');
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return $this->export( Builder::color, [
            'enable_opacity' => (int) $this->enableOpacity,
            'return_format' => $this->format,
        ] );
    }
}