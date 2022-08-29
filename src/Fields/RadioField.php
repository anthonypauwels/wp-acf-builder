<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Concerns\Choices;
use Anthonypauwels\WpAcfBuilder\Concerns\Position;

class RadioField extends AbstractField
{
    use Choices, Position;

    /** @var bool */
    protected bool $allowOtherChoice = false;

    /** @var bool */
    protected bool $saveOtherChoice = false;

    /**
     * @param bool $value
     * @return $this
     */
    public function allowOtherChoice(bool $value = true): RadioField
    {
        $this->allowOtherChoice = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function disallowOtherChoice(): RadioField
    {
        return $this->allowOtherChoice( false );
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function saveOtherChoice(bool $value = true): RadioField
    {
        $this->saveOtherChoice = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function dontSaveOtherChoice(): RadioField
    {
        return $this->saveOtherChoice( false );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_merge(
            $this->genericExport('radio'),
            [
                'choices' => $this->choices,
                'other_choice' => (int) $this->allowOtherChoice,
                'save_other_choice' => (int) $this->saveOtherChoice,
                'layout' => $this->layout,
            ]
        );
    }
}