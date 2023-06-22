<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\AbstractGroup;
use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

/**
 * Class Required
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Required
{
    /** @var int */
    protected int $required = 0;

    /**
     * @param bool $value
     * @return Required|AbstractGroup|AbstractField
     */
    public function required(bool $value = true): self
    {
        $this->required = $value;

        return $this;
    }

    /**
     * @return Required|AbstractGroup|AbstractField
     */
    public function notRequired(): self
    {
        return $this->required( false );
    }
}