<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Concerns\File;
use Anthonypauwels\WpAcfBuilder\Concerns\Image;
use Anthonypauwels\WpAcfBuilder\Concerns\Library;
use Anthonypauwels\WpAcfBuilder\Concerns\Preview;

class ImageField extends AbstractField
{
    use File, Image, Library, Preview;

    /** @var string */
    protected string $format = 'array';

    /**
     * @param string $value
     * @return $this
     */
    public function return(string $value): ImageField
    {
        if ( in_array( $value, ['array', 'url', 'id'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function returnArray(): ImageField
    {
        return $this->return('array');
    }

    /**
     * @return $this
     */
    public function returnUrl(): ImageField
    {
        return $this->return('url');
    }

    /**
     * @return $this
     */
    public function returnId(): ImageField
    {
        return $this->return('id');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_merge(
            $this->genericExport('image'),
            [
                'return_format' => $this->format,
                'preview_size' => $this->previewSize,
                'library' => $this->restrictLibrary,
                'min_width' => $this->minWidth,
                'min_height' => $this->minHeight,
                'min_size' => $this->minSize,
                'max_width' => $this->maxWidth,
                'max_height' => $this->maxHeight,
                'max_size' => $this->maxSize,
                'mime_types' => implode(',', $this->mimeTypes ),
            ]
        );
    }
}