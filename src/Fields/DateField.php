<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;

/**
 * Class DateField
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class DateField extends AbstractField
{
    /** @var string */
    protected string $displayFormat = 'd/m/Y';

    /** @var string  */
    protected string $returnFormat = 'd/m/Y';

    /** @var int  */
    protected int $weekStartsOn = 1;

    /**
     * @param string $value
     * @return $this
     */
    public function display(string $value): DateField
    {
        $this->displayFormat = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function return(string $value): DateField
    {
        $this->returnFormat = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function weekStartsOn(int $value): DateField
    {
        if ( $value >= 0 && $value <= 6 ) {
            $this->weekStartsOn = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function weekStartsOnMonday(): DateField
    {
        return $this->weekStartsOn( 1 );
    }

    /**
     * @return $this
     */
    public function weekStartsOnTuesday(): DateField
    {
        return $this->weekStartsOn( 2 );
    }

    /**
     * @return $this
     */
    public function weekStartsOnWednesday(): DateField
    {
        return $this->weekStartsOn( 3 );
    }

    /**
     * @return $this
     */
    public function weekStartsOnThursday(): DateField
    {
        return $this->weekStartsOn( 4 );
    }

    /**
     * @return $this
     */
    public function weekStartsOnFriday(): DateField
    {
        return $this->weekStartsOn( 5 );
    }

    /**
     * @return $this
     */
    public function weekStartsOnSaturday(): DateField
    {
        return $this->weekStartsOn( 6 );
    }

    /**
     * @return $this
     */
    public function weekStartsOnSunday(): DateField
    {
        return $this->weekStartsOn( 0 );
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return $this->export( Builder::date, [
            'display_format' => $this->displayFormat,
            'return_format' => $this->returnFormat,
            'first_day' => $this->weekStartsOn,
        ] );
    }
}