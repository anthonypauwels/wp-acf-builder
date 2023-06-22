<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;
use Anthonypauwels\WpAcfBuilder\Concerns\Number;
use Anthonypauwels\WpAcfBuilder\Concerns\Content;
use Anthonypauwels\WpAcfBuilder\Concerns\Placeholder;

/**
 * Class NumberField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class NumberField extends AbstractField
{
    use Number, Content, Placeholder;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Builder::number, [
            'placeholder' => $this->placeholder,
            'append' => $this->append,
            'prepend' => $this->prepend,
            'min' => $this->min > 0 ? $this->min : '',
            'max' => $this->max > 0 ? $this->max : '',
            'step' => $this->step > 0 ? $this->step : '',
        ] );
    }
}