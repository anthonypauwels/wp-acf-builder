<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\ImageField;
use Anthonypauwels\WpAcfBuilder\Fields\GalleryField;

/**
 * Class Image
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Image
{
    /** @var int */
    protected int $minWidth = 0;

    /** @var int */
    protected int $minHeight = 0;

    /** @var int */
    protected int $maxWidth = 0;

    /** @var int */
    protected int $maxHeight = 0;

    /**
     * @param int $value
     * @return ImageField|Image|GalleryField
     */
    public function minWidth(int $value): self
    {
        $this->minWidth = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return ImageField|Image|GalleryField
     */
    public function maxWidth(int $value): self
    {
        $this->maxWidth = $value;

        return $this;
    }

    /**
     * @param int $min
     * @param int $max
     * @return ImageField|Image|GalleryField
     */
    public function width(int $min, int $max = 0): self
    {
        return $this->minWidth( $min )->maxWidth( $max );
    }

    /**
     * @param int $value
     * @return ImageField|Image|GalleryField
     */
    public function minHeight(int $value): self
    {
        $this->minHeight = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return ImageField|Image|GalleryField
     */
    public function maxHeight(int $value): self
    {
        $this->maxHeight = $value;

        return $this;
    }

    /**
     * @param int $min
     * @param int $max
     * @return ImageField|Image|GalleryField
     */
    public function height(int $min, int $max = 0): self
    {
        return $this->minHeight( $min )->maxHeight( $max );
    }
}