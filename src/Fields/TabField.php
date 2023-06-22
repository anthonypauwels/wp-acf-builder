<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;

/**
 * Class TabField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class TabField extends AbstractField
{
    /** @var string */
    protected string $placement = 'top';

    /**
     * @param string $label
     * @param string|null $key
     */
    public function __construct(string $label, string $key = null)
    {
        parent::__construct( $label, '', $key );
    }

    /**
     * @param string $value
     * @return $this
     */
    public function placement(string $value): TabField
    {
        if ( in_array( $value, [ 'top', 'left' ] ) ) {
            $this->placement = $value;
        }

        return $this;
    }

    /**
     * Define the placement as top aligned
     *
     * @return $this
     */
    public function topAligned(): TabField
    {
        return $this->placement( 'top' );
    }

    /**
     * Define the placement as left aligned
     *
     * @return $this
     */
    public function leftAligned(): TabField
    {
        return $this->placement( 'left' );
    }

    /**
     *
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Builder::tab, [
            'placement' => $this->placement,
        ] );
    }
}