<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

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
        return array_merge(
            $this->genericExport('link'),
            [
                'return_format' => $this->format,
            ]
        );
    }
}