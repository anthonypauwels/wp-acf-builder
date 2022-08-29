<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait Content
{
    /** @var string */
    protected string $append = '';

    /** @var string */
    protected string $prepend = '';

    /**
     * @param string $content
     * @return AbstractField
     */
    public function append(string $content): AbstractField
    {
        $this->append = $content;

        return $this;
    }

    /**
     * @param string $content
     * @return AbstractField
     */
    public function prepend(string $content): AbstractField
    {
        $this->prepend = $content;

        return $this;
    }
}