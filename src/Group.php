<?php
namespace Anthonypauwels\WpAcfBuilder;

use Anthonypauwels\WpAcfBuilder\Contracts\Field;
use Anthonypauwels\WpAcfBuilder\Concerns\Subfields;
use Anthonypauwels\WpAcfBuilder\Concerns\Layoutable;

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
        $payload = array_merge(
            $this->genericExport('group'),
            [
                'layout' => $this->layout,
            ]
        );

        /** @var Field $field */
        foreach ( $this->fields as $field ) {
            $payload['sub_fields'][] = $field->toArray();
        }

        return $payload;
    }
}