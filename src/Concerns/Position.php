<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait Position
{
    /** @var string */
    protected string $layout = 'vertical';

    /**
     * @param string $value
     * @return AbstractField
     */
    public function layout(string $value): AbstractField
    {
        if ( in_array( $value, ['horizontal', 'vertical'] ) ) {
            $this->layout = $value;
        }

        return $this;
    }

    /**
     * @return AbstractField
     */
    public function vertical(): AbstractField
    {
        return $this->layout( 'vertical' );
    }

    /**
     * @return AbstractField
     */
    public function horizontal(): AbstractField
    {
        return $this->layout( 'horizontal' );
    }
}