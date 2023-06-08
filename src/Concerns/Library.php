<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait Library
{
    /** @var string */
    protected string $restrictLibrary = 'all';

    /**
     * @param string $value
     * @return $this
     */
    public function restrictLibrary(string $value): self
    {
        if ( in_array( $value, ['all', 'uploadedTo'] ) ) {
            $this->restrictLibrary = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function showAll(): self
    {
        return $this->restrictLibrary('all');
    }

    /**
     * @return $this
     */
    public function onlyUploaded(): self
    {
        return $this->restrictLibrary('uploadedTo');
    }
}