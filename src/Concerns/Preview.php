<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\FileField;
use Anthonypauwels\WpAcfBuilder\Fields\ImageField;
use Anthonypauwels\WpAcfBuilder\Fields\GalleryField;

/**
 * Class Preview
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Preview
{
    /** @var string */
    protected string $previewSize = 'thumbnail';

    /**
     * @param string $value
     * @return FileField|Preview|GalleryField|ImageField
     */
    public function previewSize(string $value): self
    {
        $this->previewSize = $value;

        return $this;
    }

    /**
     * @return FileField|Preview|GalleryField|ImageField
     */
    public function previewThumbnail(): self
    {
        return $this->previewSize('thumbnail');
    }

    /**
     * @return FileField|Preview|GalleryField|ImageField
     */
    public function previewMedium(): self
    {
        return $this->previewSize('medium');
    }

    /**
     * @return FileField|Preview|GalleryField|ImageField
     */
    public function previewMediumLarge(): self
    {
        return $this->previewSize('medium_large');
    }

    /**
     * @return FileField|Preview|GalleryField|ImageField
     */
    public function previewLarge(): self
    {
        return $this->previewSize('large');
    }

    /**
     * @return FileField|Preview|GalleryField|ImageField
     */
    public function previewFullSize(): self
    {
        return $this->previewSize('full_size');
    }
}