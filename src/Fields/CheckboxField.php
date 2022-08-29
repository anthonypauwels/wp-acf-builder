<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Concerns\Choices;
use Anthonypauwels\WpAcfBuilder\Concerns\Position;

class CheckboxField extends AbstractField
{
    use Choices, Position;

    /** @var bool */
    protected bool $allowCustom = false;

    /** @var bool */
    protected bool $saveCustom = false;

    /** @var bool */
    protected bool $toggle = false;

    /** @var string */
    protected string $format = 'value';

    /**
     * @param bool $value
     * @return $this
     */
    public function allowCustom(bool $value = true): CheckboxField
    {
        $this->allowCustom = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function disallowCustom(): CheckboxField
    {
        return $this->allowCustom( false );
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function saveCustom(bool $value = true): CheckboxField
    {
        $this->saveCustom = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function dontSaveCustom(): CheckboxField
    {
        return $this->saveCustom( false );
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function showToggleAll(bool $value = true): CheckboxField
    {
        $this->toggle = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function hideToggleAll(): CheckboxField
    {
        return $this->showToggleAll( false );
    }

    /**
     * @param string $value
     * @return $this
     */
    public function return(string $value): CheckboxField
    {
        if ( in_array( $value, ['value', 'label', 'array'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function returnValue(): CheckboxField
    {
        return $this->return('value');
    }

    /**
     * @return $this
     */
    public function returnLabel(): CheckboxField
    {
        return $this->return('label');
    }

    /**
     * @return $this
     */
    public function returnArray(): CheckboxField
    {
        return $this->return('array');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_merge(
            $this->genericExport('checkbox'),
            [
                'choices' => $this->choices,
                'layout' => $this->layout,
                'allow_custom' => $this->allowCustom,
                'save_custom' => $this->saveCustom,
                'toggle' => $this->toggle,
                'return_format' => $this->format,
            ]
        );
    }
}