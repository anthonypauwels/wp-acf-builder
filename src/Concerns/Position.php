<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\RadioField;
use Anthonypauwels\WpAcfBuilder\Fields\CheckboxField;
use Anthonypauwels\WpAcfBuilder\Fields\ButtonGroupField;

/**
 * Class Position
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Position
{
    /** @var string */
    protected string $layout = 'vertical';

    /**
     * @param string $value
     * @return RadioField|Position|ButtonGroupField|CheckboxField
     */
    public function layout(string $value): self
    {
        if ( in_array( $value, ['horizontal', 'vertical'] ) ) {
            $this->layout = $value;
        }

        return $this;
    }

    /**
     * @return RadioField|Position|ButtonGroupField|CheckboxField
     */
    public function vertical(): self
    {
        return $this->layout( 'vertical' );
    }

    /**
     * @return RadioField|Position|ButtonGroupField|CheckboxField
     */
    public function horizontal(): self
    {
        return $this->layout( 'horizontal' );
    }
}