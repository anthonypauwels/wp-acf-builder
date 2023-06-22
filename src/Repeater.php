<?php
namespace Anthonypauwels\WpAcfBuilder;

use Anthonypauwels\WpAcfBuilder\Contracts\Field;
use Anthonypauwels\WpAcfBuilder\Concerns\Button;
use Anthonypauwels\WpAcfBuilder\Concerns\MinMax;
use Anthonypauwels\WpAcfBuilder\Concerns\Subfields;
use Anthonypauwels\WpAcfBuilder\Concerns\Layoutable;

/**
 * Class Repeater
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class Repeater extends AbstractGroup implements Field
{
    use Button, MinMax, Subfields, Layoutable;

    /**
     *
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Builder::repeater, [
            'layout' => $this->layout,
            'button_label' => $this->button,
            'min' => $this->min,
            'max' => $this->max,
            'fields' => array_map( function (Field $field) {
                return $field->toArray();
            }, $this->fields ),
        ] );
    }
}