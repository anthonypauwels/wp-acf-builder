<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;

/**
 * Class OEmbedField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class OEmbedField extends AbstractField
{
    /** @var int */
    protected int $width = 0;

    /** @var int */
    protected int $height = 0;

    /**
     * @param int $width
     * @return $this
     */
    public function width(int $width): OEmbedField
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @param int $height
     * @return $this
     */
    public function height(int $height): OEmbedField
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @param int $width
     * @param int $height
     * @return $this
     */
    public function dimension(int $width, int $height): OEmbedField
    {
        return $this->width( $width )->height( $height );
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return $this->export( Builder::oembed, [
            'width' => $this->width > 0 ? $this->width : '',
            'height' => $this->height > 0 ? $this->height : '',
        ] );
    }
}