<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\FileField;
use Anthonypauwels\WpAcfBuilder\Fields\ImageField;
use Anthonypauwels\WpAcfBuilder\Fields\GalleryField;

/**
 * Class Library
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Library
{
    /** @var string */
    protected string $restrictLibrary = 'all';

    /**
     * @param string $value
     * @return FileField|Library|GalleryField|ImageField
     */
    public function restrictLibrary(string $value): self
    {
        if ( in_array( $value, ['all', 'uploadedTo'] ) ) {
            $this->restrictLibrary = $value;
        }

        return $this;
    }

    /**
     * @return FileField|Library|GalleryField|ImageField
     */
    public function showAll(): self
    {
        return $this->restrictLibrary('all');
    }

    /**
     * @return FileField|Library|GalleryField|ImageField
     */
    public function onlyUploaded(): self
    {
        return $this->restrictLibrary('uploadedTo');
    }
}