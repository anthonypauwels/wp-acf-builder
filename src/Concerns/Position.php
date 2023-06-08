<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait Position
{
    /** @var string */
    protected string $layout = 'vertical';

    /**
     * @param string $value
     * @return $this
     */
    public function layout(string $value): self
    {
        if ( in_array( $value, ['horizontal', 'vertical'] ) ) {
            $this->layout = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function vertical(): self
    {
        return $this->layout( 'vertical' );
    }

    /**
     * @return $this
     */
    public function horizontal(): self
    {
        return $this->layout( 'horizontal' );
    }
}