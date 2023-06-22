<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;

/**
 * Class DateTimeField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class DateTimeField extends DateField
{
    /** @var string */
    protected string $displayFormat = 'd/m/Y g:i a';

    /** @var string  */
    protected string $returnFormat = 'd/m/Y g:i a';

    /**
     * @return array
     */
    public function toArray():array
    {
        return $this->export( Builder::dateTime, [
            'display_format' => $this->displayFormat,
            'return_format' => $this->returnFormat,
            'first_day' => $this->weekStartsOn,
        ] );
    }
}