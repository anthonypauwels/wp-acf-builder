<?php
namespace Anthonypauwels\WpAcfBuilder\Fields;

use Anthonypauwels\WpAcfBuilder\Builder;
use Anthonypauwels\WpAcfBuilder\Contracts\Field;
use Anthonypauwels\WpAcfBuilder\Concerns\Wrapper;
use Anthonypauwels\WpAcfBuilder\Concerns\Required;
use Anthonypauwels\WpAcfBuilder\Concerns\Jsonable;
use Anthonypauwels\WpAcfBuilder\Concerns\OnFilters;
use Anthonypauwels\WpAcfBuilder\Concerns\Instruction;
use Anthonypauwels\WpAcfBuilder\Concerns\Conditional;
use Anthonypauwels\WpAcfBuilder\Concerns\DefaultValue;

abstract class AbstractField implements Field
{
    use Jsonable, Wrapper, Conditional, Required, DefaultValue, Instruction, OnFilters;

    /** @var string */
    protected string $key;

    /** @var string */
    protected string $label;

    /** @var string */
    protected string $name;

    /** @var array */
    protected array $params = [];

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
        $this->name = wp_acf_builder_slugify( $name );
        $this->key = wp_acf_builder_slugify( $key );
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function param(string $key, mixed $value): AbstractField
    {
        $this->params[ $key ] = $value;

        return $this;
    }

    /**
     * @param string $type
     * @return array
     */
    protected function genericExport(string $type): array
    {
        return array_merge(
            Builder::getParams(),
            $this->params, [
            'key' => $this->getKey(),
            'name' => $this->name,
            'label' => $this->label,
            'type' => $type,
            'instructions' => $this->instructions,
            'required' => $this->required,
            'conditional_logic' => empty( $this->conditionalLogic ) ? 0 : $this->conditionalLogic,
            'wrapper' => $this->wrapperAttributes,
            'default_value' => $this->default,
        ] );
    }

    /**
     * Return the generated field key
     *
     * @return string
     */
    protected function getKey(): string
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