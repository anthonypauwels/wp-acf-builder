<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Concerns\Message;
use Anthonypauwels\WpAcfBuilder\Concerns\NewLines;

class MessageField extends AbstractField
{
    use Message, NewLines;

    /** @var bool */
    protected bool $escHtml = false;

    /**
     * @param bool $value
     * @return $this
     */
    public function escapeHtml(bool $value = true): MessageField
    {
        $this->escHtml = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function dontEscapeHtml(): MessageField
    {
        return $this->escapeHtml( false );
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return array_merge(
            $this->genericExport('message'),
            [
                'message' => $this->message,
                'new_lines' => $this->newLines,
                'esc_html' => (int) $this->escHtml,
            ]
        );
    }
}