<?php
namespace Anthonypauwels\WpAcfBuilder;

use Anthonypauwels\WpAcfBuilder\Contracts\Field;
use Anthonypauwels\WpAcfBuilder\Concerns\Button;
use Anthonypauwels\WpAcfBuilder\Concerns\MinMax;
use Anthonypauwels\WpAcfBuilder\Concerns\Subfields;
use Anthonypauwels\WpAcfBuilder\Concerns\Layoutable;

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
        $payload = array_merge(
            $this->genericExport('repeater'),
            [
                'layout' => $this->layout,
                'button_label' => $this->button,
            ]
        );

        /** @var Field $field */
        foreach ( $this->fields as $field ) {
            $payload['sub_fields'][] = $field->toArray();
        }

        return $payload;
    }
}