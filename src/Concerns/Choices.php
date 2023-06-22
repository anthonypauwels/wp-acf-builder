<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\RadioField;
use Anthonypauwels\WpAcfBuilder\Fields\SelectField;
use Anthonypauwels\WpAcfBuilder\Fields\CheckboxField;
use Anthonypauwels\WpAcfBuilder\Fields\ButtonGroupField;

/**
 * Class Choices
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Choices
{
    /** @var array */
    protected array $choices = [];

    /**
     * @param array $choices
     * @return SelectField|Choices|ButtonGroupField|CheckboxField|RadioField
     */
    public function choices(array $choices): self
    {
        $this->choices = $choices;

        return $this;
    }
}