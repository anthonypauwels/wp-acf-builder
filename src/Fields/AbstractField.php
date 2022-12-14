<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Contracts\Field;
use Anthonypauwels\WpAcfBuilder\Concerns\Wrapper;
use Anthonypauwels\WpAcfBuilder\Concerns\Required;
use Anthonypauwels\WpAcfBuilder\Concerns\Jsonable;
use Anthonypauwels\WpAcfBuilder\Concerns\Instruction;
use Anthonypauwels\WpAcfBuilder\Concerns\Conditional;
use Anthonypauwels\WpAcfBuilder\Concerns\DefaultValue;

abstract class AbstractField implements Field
{
    use Jsonable, Wrapper, Conditional, Required, DefaultValue, Instruction;

    /** @var string */
    protected string $key;

    /** @var string */
    protected string $label;

    /** @var string */
    protected string $name;

    /**
     * @param string $label
     * @param string|null $name
     * @param string|null $key
     */
    public function __construct(string $label, string $name = null, string $key = null)
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $this->label = $label;
        $this->name = slugify( $name );
        $this->key = slugify( $key );
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function onLoad(callable $callback): AbstractField
    {
        add_filter('acf/load_field/key=' . $this->getFieldKey(), $callback );

        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function onValue(callable $callback): AbstractField
    {
        add_filter('acf/load_value/key=' . $this->getFieldKey(), $callback );

        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function onUpdate(callable $callback): AbstractField
    {
        add_filter('acf/update_field/key=' . $this->getFieldKey(), $callback, 10, 3 );

        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function onFormat(callable $callback): AbstractField
    {
        add_filter('acf/format_value/key=' . $this->getFieldKey(), $callback, 10, 3 );

        return $this;
    }

    /**
     * @param string $type
     * @return array
     */
    protected function genericExport(string $type): array
    {
        return [
            'key' => $this->getFieldKey(),
            'name' => $this->name,
            'label' => $this->label,
            'type' => $type,
            'instructions' => $this->instructions,
            'required' => $this->required,
            'conditional_logic' => empty( $this->conditionalLogic ) ? 0 : $this->conditionalLogic,
            'wrapper' => $this->wrapperAttributes,
            'default_value' => $this->default,
        ];
    }

    /**
     * Return the generated field key
     *
     * @return string
     */
    protected function getFieldKey(): string
    {
        return '_acf_field_' . $this->key;
    }

    /**
     * Dump and Debug
     *
     * @return void
     */
    public function dd(): void
    {
        if ( function_exists('dd') ) {
            dd( $this->toArray() );
        } else {
            var_dump( $this->toArray() );
            exit;
        }
    }
}