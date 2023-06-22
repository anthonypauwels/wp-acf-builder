<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;

/**
 * Class LinkField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class LinkField extends AbstractField
{
    /** @var string */
    protected string $format = 'array';

    /**
     * @param string $value
     * @return $this
     */
    public function return(string $value): LinkField
    {
        if ( in_array( $value, ['array', 'url'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function returnArray(): LinkField
    {
        return $this->return('array');
    }

    /**
     * @return $this
     */
    public function returnUrl(): LinkField
    {
        return $this->return('url');
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return $this->export( Builder::link, [
            'return_format' => $this->format,
        ] );
    }
}