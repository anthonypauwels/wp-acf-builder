<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\TextField;
use Anthonypauwels\WpAcfBuilder\Fields\TextareaField;

/**
 * Class Disabled
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Disabled
{
    /** @var bool */
    protected bool $disabled = false;

    /**
     * @param bool $value
     * @return TextareaField|Disabled|TextField
     */
    public function disable(bool $value = true): self
    {
        $this->disabled = $value;

        return $this;
    }

    /**
     * @return TextareaField|Disabled|TextField
     */
    public function enable(): self
    {
        return $this->disable( false );
    }
}