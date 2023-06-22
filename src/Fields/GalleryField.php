<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;
use Anthonypauwels\WpAcfBuilder\Concerns\File;
use Anthonypauwels\WpAcfBuilder\Concerns\Image;
use Anthonypauwels\WpAcfBuilder\Concerns\MinMax;
use Anthonypauwels\WpAcfBuilder\Concerns\Library;
use Anthonypauwels\WpAcfBuilder\Concerns\Preview;

/**
 * Class GalleryField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class GalleryField extends AbstractField
{
    use File, Image, Library, Preview, MinMax;

    /** @var string */
    protected string $format = 'array';

    /** @var string */
    protected string $insert = 'append';

    /**
     * @param string $value
     * @return $this
     */
    public function return(string $value): GalleryField
    {
        if ( in_array( $value, ['array', 'url', 'id'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function returnArray(): GalleryField
    {
        return $this->return('array');
    }

    /**
     * @return $this
     */
    public function returnUrl(): GalleryField
    {
        return $this->return('url');
    }

    /**
     * @return $this
     */
    public function returnId(): GalleryField
    {
        return $this->return('id');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function insertNew(string $value): GalleryField
    {
        if ( in_array( $value, ['append', 'prepend'] ) ) {
            $this->insert = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function insertAppend(): GalleryField
    {
        return $this->insertNew( 'append' );
    }

    /**
     * @return $this
     */
    public function insertPrepend(): GalleryField
    {
        return $this->insertNew( 'prepend' );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Builder::gallery, [
            'return_format' => $this->format,
            'preview_size' => $this->previewSize,
            'insert' => $this->insert,
            'library' => $this->restrictLibrary,
            'min_width' => $this->minWidth,
            'min_height' => $this->minHeight,
            'min_size' => $this->minSize,
            'max_width' => $this->maxWidth,
            'max_height' => $this->maxHeight,
            'max_size' => $this->maxSize,
            'mime_types' => implode(',', $this->mimeTypes ),
            'min' => $this->min,
            'max' => $this->max,
        ] );
    }
}