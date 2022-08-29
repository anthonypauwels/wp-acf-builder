<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait Choices
{
    /** @var array */
    protected array $choices = [];

    /**
     * @param array $choices
     * @return AbstractField
     */
    public function choices(array $choices): AbstractField
    {
        $this->choices = $choices;

        return $this;
    }
}