<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\BooleanField;
use Anthonypauwels\WpAcfBuilder\Fields\MessageField;

/**
 * Class Message
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait Message
{
    /** @var string */
    protected string $message = '';

    /**
     * @param string $content
     * @return MessageField|Message|BooleanField
     */
    public function message(string $content): self
    {
        $this->message = $content;

        return $this;
    }
}