<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;
use Anthonypauwels\WpAcfBuilder\Concerns\Choices;
use Anthonypauwels\WpAcfBuilder\Concerns\Nullable;
use Anthonypauwels\WpAcfBuilder\Concerns\Position;

/**
 * Class ButtonGroupField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class ButtonGroupField extends AbstractField
{
    use Choices, Nullable, Position;

    /**
     * @return array
     */
    public function toArray():array
    {
        return $this->export( Builder::buttonGroup, [
            'choices' => $this->choices,
            'layout' => $this->layout,
            'allow_null' => (int) $this->nullable,
        ] );
    }
}