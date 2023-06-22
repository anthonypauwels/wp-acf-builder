<?php
namespace Anthonypauwels\WpAcfBuilder;

use Anthonypauwels\WpAcfBuilder\Contracts\Field;
use Anthonypauwels\WpAcfBuilder\Concerns\Subfields;
use Anthonypauwels\WpAcfBuilder\Concerns\Layoutable;

/**
 * Class Group
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class Group extends AbstractGroup implements Field
{
    use Layoutable, Subfields;

    /**
     *
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Builder::group, [
            'layout' => $this->layout,
            'sub_fields' => array_map( function (Field $field) {
                return $field->toArray();
            }, $this->fields ),
        ] );
    }
}