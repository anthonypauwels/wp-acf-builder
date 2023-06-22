<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;
use Anthonypauwels\WpAcfBuilder\Concerns\Placeholder;

/**
 * Class UrlField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class UrlField extends AbstractField
{
    use Placeholder;

    /**
     * @return array
     */
    public function toArray():array
    {
        return $this->export( Builder::url, [
            'placeholder' => $this->placeholder,
        ] );
    }
}