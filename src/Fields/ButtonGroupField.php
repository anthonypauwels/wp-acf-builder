<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Concerns\Choices;
use Anthonypauwels\WpAcfBuilder\Concerns\Nullable;
use Anthonypauwels\WpAcfBuilder\Concerns\Position;

class ButtonGroupField extends AbstractField
{
    use Choices, Nullable, Position;

    /**
     * @return array
     */
    public function toArray():array
    {
        return array_merge(
            $this->genericExport('button_group'),
            [
                'choices' => $this->choices,
                'layout' => $this->layout,
                'allow_null' => (int) $this->nullable,
            ]
        );
    }
}