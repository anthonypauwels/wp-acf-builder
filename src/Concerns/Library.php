<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait Library
{
    /** @var string */
    protected string $restrictLibrary = 'all';

    /**
     * @param string $value
     * @return AbstractField
     */
    public function restrictLibrary(string $value): AbstractField
    {
        if ( in_array( $value, ['all', 'uploadedTo'] ) ) {
            $this->restrictLibrary = $value;
        }

        return $this;
    }

    /**
     * @return AbstractField
     */
    public function showAll(): AbstractField
    {
        return $this->restrictLibrary('all');
    }

    /**
     * @return AbstractField
     */
    public function onlyUploaded(): AbstractField
    {
        return $this->restrictLibrary('uploadedTo');
    }
}