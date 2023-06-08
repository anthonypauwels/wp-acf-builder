<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait Preview
{
    /** @var string */
    protected string $previewSize = 'thumbnail';

    /**
     * @param string $value
     * @return $this
     */
    public function previewSize(string $value): self
    {
        $this->previewSize = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function previewThumbnail(): self
    {
        return $this->previewSize('thumbnail');
    }

    /**
     * @return $this
     */
    public function previewMedium(): self
    {
        return $this->previewSize('medium');
    }

    /**
     * @return $this
     */
    public function previewMediumLarge(): self
    {
        return $this->previewSize('medium_large');
    }

    /**
     * @return $this
     */
    public function previewLarge(): self
    {
        return $this->previewSize('large');
    }

    /**
     * @return $this
     */
    public function previewFullSize(): self
    {
        return $this->previewSize('full_size');
    }
}