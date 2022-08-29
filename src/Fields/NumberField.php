<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Concerns\Number;
use Anthonypauwels\WpAcfBuilder\Concerns\Content;
use Anthonypauwels\WpAcfBuilder\Concerns\Placeholder;

class NumberField extends AbstractField
{
    use Number, Content, Placeholder;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_merge(
            $this->genericExport('number'),
            [
                'placeholder' => $this->placeholder,
                'append' => $this->append,
                'prepend' => $this->prepend,
                'min' => $this->min > 0 ? $this->min : '',
                'max' => $this->max > 0 ? $this->max : '',
                'step' => $this->step > 0 ? $this->step : '',
            ]
        );
    }
}