<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Concerns\Choices;
use Anthonypauwels\WpAcfBuilder\Concerns\Multiple;
use Anthonypauwels\WpAcfBuilder\Concerns\Nullable;
use Anthonypauwels\WpAcfBuilder\Concerns\Placeholder;

class SelectField extends AbstractField
{
    use Choices, Nullable, Placeholder, Multiple;

    /** @var bool */
    protected bool $ui = false;

    /** @var bool */
    protected bool $ajax = false;

    /**
     * @param string $value
     * @return $this
     */
    public function ui(string $value): SelectField
    {
        if ( in_array( $value, ['default', 'select2'] ) ) {
            $this->ui = $value === 'select2';
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function defaultUi(): SelectField
    {
        $this->ui = false;

        return $this;
    }

    /**
     * @return $this
     */
    public function select2Ui(): SelectField
    {
        $this->ui = true;

        return $this;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function useAjax(bool $value = true): SelectField
    {
        $this->ajax = $value;

        return $this;
    }

    public function dontUseAjax(): SelectField
    {
        $this->ajax = false;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        if ( $this->ui || $this->ajax || strlen( $this->placeholder ) > 0 ) {
            $this->select2Ui();
        }

        return array_merge(
            $this->genericExport('select'),
            [
                'choice' => $this->choices,
                'allow_null' => (int) $this->nullable,
                'multiple' => (int) $this->multiple,
                'ui' => (int) $this->ui,
                'ajax' => (int) $this->ajax,
                'placeholder' => $this->placeholder,
            ]
        );
    }
}