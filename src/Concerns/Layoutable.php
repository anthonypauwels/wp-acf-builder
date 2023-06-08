<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait Layoutable
{
    /** @var string */
    protected string $layout = 'block';

    /**
     * @param string $value
     * @return $this
     */
    public function layout(string $value):self
    {
        if ( in_array( $value, [ 'block', 'table', 'row' ] ) ) {
            $this->layout = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function blockLayout():self
    {
        return $this->layout( 'block' );
    }

    /**
     * @return $this
     */
    public function tableLayout():self
    {
        return $this->layout( 'table' );
    }

    /**
     * @return $this
     */
    public function rowLayout():self
    {
        return $this->layout( 'row' );
    }
}