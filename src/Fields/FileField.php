<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Concerns\File;
use Anthonypauwels\WpAcfBuilder\Concerns\Library;
use Anthonypauwels\WpAcfBuilder\Concerns\Preview;

class FileField extends AbstractField
{
    use Library, File, Preview;

    /** @var string */
    protected string $format = 'array';

    /**
     * @param string $value
     * @return $this
     */
    public function return(string $value): FileField
    {
        if ( in_array( $value, ['array', 'url', 'id'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function returnArray(): FileField
    {
        return $this->return('array');
    }

    /**
     * @return $this
     */
    public function returnUrl(): FileField
    {
        return $this->return('url');
    }

    /**
     * @return $this
     */
    public function returnId(): FileField
    {
        return $this->return('id');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_merge(
            $this->genericExport('field'),
            [
                'return_format' => $this->format,
                'preview_size' => $this->previewSize,
                'library' => $this->restrictLibrary,
                'min_size' => $this->minSize,
                'max_size' => $this->maxSize,
                'mime_types' => implode(',', $this->mimeTypes ),
            ]
        );
    }
}