<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;
use Anthonypauwels\WpAcfBuilder\Concerns\Number;
use Anthonypauwels\WpAcfBuilder\Concerns\Content;

/**
 * Class RangeField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class RangeField extends AbstractField
{
    use Content, Number;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Builder::range, [
            'append' => $this->append,
            'prepend' => $this->prepend,
            'min' => $this->min > 0 ? $this->min : '',
            'max' => $this->max > 0 ? $this->max : '',
            'step' => $this->step > 0 ? $this->step : '',
        ] );
    }
}