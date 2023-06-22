<?php
namespace Anthonypauwels\WpAcfBuilder;

use Anthonypauwels\WpAcfBuilder\Contracts\Field;
use Anthonypauwels\WpAcfBuilder\Concerns\Subfields;
use Anthonypauwels\WpAcfBuilder\Concerns\Layoutable;

/**
 * Class Layout
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class Layout extends AbstractGroup
{
    use Subfields, Layoutable;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Builder::layout, [
            'layout' => $this->layout,
            'fields' => array_map( function (Field $field) {
                return $field->toArray();
            }, $this->fields ),
        ] );
    }
}