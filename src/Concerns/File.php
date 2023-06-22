<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\FileField;
use Anthonypauwels\WpAcfBuilder\Fields\ImageField;
use Anthonypauwels\WpAcfBuilder\Fields\GalleryField;

/**
 * Class File
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait File
{
    /** @var int */
    protected int $minSize = 0;

    /** @var int */
    protected int $maxSize = 0;

    /** @var array */
    protected array $mimeTypes = [];

    /**
     * @param ...$mime_types
     * @return FileField|File|GalleryField|ImageField
     */
    public function mimeTypes(...$mime_types): self
    {
        $this->mimeTypes = $mime_types;

        return $this;
    }

    /**
     * @param int $value
     * @param string $unit
     * @return FileField|File|GalleryField|ImageField
     */
    public function minSize(int $value, string $unit = 'MB'): self
    {
        $this->minSize = $value . trim( $unit );

        return $this;
    }

    /**
     * @param int $value
     * @param string $unit
     * @return FileField|File|GalleryField|ImageField
     */
    public function maxSize(int $value, string $unit = 'MB'): self
    {
        $this->maxSize = $value . trim( $unit );

        return $this;
    }

    /**
     * @param int $min
     * @param int $max
     * @param string $unit
     * @return FileField|File|GalleryField|ImageField
     */
    public function size(int $min, int $max = 0, string $unit = 'MB'): self
    {
        if ( is_string( $max ) ) {
            $unit = $max;
            $max = 0;
        }

        return $this->minSize( $min, $unit )->maxSize( $max, $unit );
    }
}