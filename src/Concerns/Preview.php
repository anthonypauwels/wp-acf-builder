<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait Preview
{
    /** @var string */
    protected string $previewSize = 'thumbnail';

    /**
     * @param string $value
     * @return AbstractField
     */
    public function previewSize(string $value): AbstractField
    {
        $this->previewSize = $value;

        return $this;
    }

    /**
     * @return AbstractField
     */
    public function previewThumbnail(): AbstractField
    {
        return $this->previewSize('thumbnail');
    }

    /**
     * @return AbstractField
     */
    public function previewMedium(): AbstractField
    {
        return $this->previewSize('medium');
    }

    /**
     * @return AbstractField
     */
    public function previewMediumLarge(): AbstractField
    {
        return $this->previewSize('medium_large');
    }

    /**
     * @return AbstractField
     */
    public function previewLarge(): AbstractField
    {
        return $this->previewSize('large');
    }

    /**
     * @return AbstractField
     */
    public function previewFullSize(): AbstractField
    {
        return $this->previewSize('full_size');
    }
}