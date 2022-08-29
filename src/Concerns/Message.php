<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait Message
{
    /** @var string */
    protected string $message = '';

    /**
     * @param string $content
     * @return AbstractField
     */
    public function message(string $content): AbstractField
    {
        $this->message = $content;

        return $this;
    }
}