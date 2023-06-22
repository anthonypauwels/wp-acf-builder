<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Group;
use Anthonypauwels\WpAcfBuilder\Layout;
use Anthonypauwels\WpAcfBuilder\Repeater;

/**
 * Class Layoutable
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Layoutable
{
    /** @var string */
    protected string $layout = 'block';

    /**
     * @param string $value
     * @return Repeater|Layoutable|Group|Layout
     */
    public function layout(string $value):self
    {
        if ( in_array( $value, [ 'block', 'table', 'row' ] ) ) {
            $this->layout = $value;
        }

        return $this;
    }

    /**
     * @return Repeater|Layoutable|Group|Layout
     */
    public function blockLayout():self
    {
        return $this->layout( 'block' );
    }

    /**
     * @return Repeater|Layoutable|Group|Layout
     */
    public function tableLayout():self
    {
        return $this->layout( 'table' );
    }

    /**
     * @return Repeater|Layoutable|Group|Layout
     */
    public function rowLayout():self
    {
        return $this->layout( 'row' );
    }
}