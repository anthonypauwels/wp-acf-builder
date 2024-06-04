<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\TextField;
use Anthonypauwels\WpAcfBuilder\Fields\TextareaField;

/**
 * Class CanBeReadOnly
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait CanBeReadOnly
{
    /** @var bool */
    protected bool $readOnly = false;

    /**
     * @param bool $value
     * @return TextareaField|CanBeReadOnly|TextField
     */
    public function isReadOnly(bool $value = true): self
    {
        $this->readOnly = $value;

        return $this;
    }

    /**
     * @return TextareaField|CanBeReadOnly|TextField
     */
    public function notReadOnly(): self
    {
        return $this->isReadOnly( false );
    }
}