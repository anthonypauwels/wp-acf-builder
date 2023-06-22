<?php
namespace Anthonypauwels\WpAcfBuilder;

use Anthonypauwels\WpAcfBuilder\Contracts\Group;
use Anthonypauwels\WpAcfBuilder\Concerns\Wrapper;
use Anthonypauwels\WpAcfBuilder\Concerns\Jsonable;
use Anthonypauwels\WpAcfBuilder\Concerns\Required;
use Anthonypauwels\WpAcfBuilder\Concerns\OnFilters;
use Anthonypauwels\WpAcfBuilder\Concerns\Instruction;
use Anthonypauwels\WpAcfBuilder\Concerns\Conditional;
use Anthonypauwels\WpAcfBuilder\Concerns\DefaultValue;

/**
 * Class AbstractGroup
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
abstract class AbstractGroup implements Group
{
    use Jsonable, Conditional, Wrapper, Required, DefaultValue, Instruction, OnFilters;

    /** @var string */
    protected string $name;

    /** @var string */
    protected string $label;

    /** @var string */
    protected string $key;

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
     * @param string $instructions
     * @return $this
     */
    public function instructions(string $instructions): AbstractGroup
    {
        $this->instructions = $instructions;

        return $this;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function param(string $key, mixed $value): AbstractGroup
    {
        $this->params[ $key ] = $value;

        return $this;
    }

    /**
     * @param string $type
     * @param array $more_params
     * @return array
     */
    protected function export(string $type, array $more_params = []): array
    {
        return array_merge(
            $this->params, [
            'key' => $this->getKey(),
            'name' => $this->name,
            'label' => $this->label,
            'sub_fields' => [],
            'type' => $type,
            'instructions' => $this->instructions,
            'required' => $this->required,
            'conditional_logic' => empty( $this->conditionalLogic ) ? 0 : $this->conditionalLogic,
            'wrapper' => $this->wrapperAttributes,
            'default_value' => $this->default,
        ], Builder::getFieldConfig( $type ),
            $more_params
        );
    }

    /**
     * Return the generated group key
     *
     * @return string
     */
    protected function getKey(): string
    {
        return '_acf_group_' . $this->key;
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