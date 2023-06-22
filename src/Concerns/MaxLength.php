<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\TextField;
use Anthonypauwels\WpAcfBuilder\Fields\TextareaField;

/**
 * Class MaxLength
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait MaxLength
{
    /** @var int */
    protected int $maxLength = 0;

    /**
     * @param int $limit
     * @return TextareaField|MaxLength|TextField
     */
    public function maxLength(int $limit): self
    {
        $this->maxLength = $limit;

        return $this;
    }
}