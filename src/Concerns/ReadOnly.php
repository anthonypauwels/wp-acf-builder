<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\TextField;
use Anthonypauwels\WpAcfBuilder\Fields\TextareaField;

/**
 * Class ReadOnly
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait ReadOnly
{
    /** @var bool */
    protected bool $readOnly = false;

    /**
     * @param bool $value
     * @return TextareaField|ReadOnly|TextField
     */
    public function readOnly(bool $value = true): self
    {
        $this->readOnly = $value;

        return $this;
    }

    /**
     * @return TextareaField|ReadOnly|TextField
     */
    public function notReadOnly(): self
    {
        return $this->readOnly( false );
    }
}