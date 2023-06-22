<?php
namespace Anthonypauwels\WpAcfBuilder;

use Anthonypauwels\WpAcfBuilder\Contracts\Field;
use Anthonypauwels\WpAcfBuilder\Contracts\Group;
use Anthonypauwels\WpAcfBuilder\Concerns\Jsonable;
use Anthonypauwels\WpAcfBuilder\Concerns\Subfields;

/**
 * Class Location
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class Location implements Group
{
    use Subfields, Jsonable;

    /** @var string */
    protected string $key;

    /** @var string */
    protected string $name;

    /** @var array */
    protected array $location = [];

    /** @var int */
    protected int $menuOrder = 0;

    /** @var string */
    protected string $position = 'normal';

    /** @var string */
    protected string $style = 'default';

    /** @var string */
    protected string $labelPlacement = 'top';

    /** @var string */
    protected string $instructionPlacement = 'label';

    /** @var array */
    protected array $hideOnScreen = [];

    /** @var bool */
    protected bool $active = true;

    /** @var bool */
    protected bool $showInApi = true;

    /** @var string */
    protected string $description = '';

    /**
     * @param string $name
     * @param string|null $key
     */
    public function __construct(string $name, string $key = null)
    {
        if ( $key === null ) {
            $key = wp_acf_builder_slugify( $name );
        }

        $this->key = 'group_' . $key;
        $this->name = $name;
    }

    /**
     * @param string $param
     * @param string $operator
     * @param string|null $value
     * @param string $boolean
     * @return $this
     */
    public function showIf(string $param, string $operator, string $value = null, string $boolean = 'and'): Location
    {
        if ( func_num_args() === 2 ) {
            $value = $operator;
            $operator = '==';
        }

        if ( !in_array( $operator, [ '==', '!=' ] ) ) {
            $operator = '==';
        }

        $conditional = compact('param', 'operator', 'value');

        if ( $boolean === 'and' ) {
            $last = array_key_last( $this->location );

            if ( $last !== null ) {
                $this->location[ $last ][] = $conditional;
            } else {
                $this->location[] = [
                    $conditional
                ];
            }
        }

        if ( $boolean === 'or' ) {
            $this->location[] = [
                $conditional
            ];
        }

        return $this;
    }

    /**
     * @param string $param
     * @param string $operator
     * @param string|null $value
     * @return $this
     */
    public function andShowIf(string $param, string $operator, string $value = null): Location
    {
        return $this->showIf( $param, $operator, $value );
    }

    /**
     * @param string $param
     * @param string $operator
     * @param string|null $value
     * @return $this
     */
    public function orShowIf(string $param, string $operator, string $value = null): Location
    {
        return $this->showIf( $param, $operator, $value, 'or' );
    }

    /**
     * @param int $value
     * @return $this
     */
    public function priorityOrder(int $value): Location
    {
        $this->menuOrder = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function position(string $value): Location
    {
        if ( in_array( $value, [ 'side', 'acf_after_title', 'normal' ] ) ) {
            $this->position = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function positionOnSide(): Location
    {
        return $this->position('side');
    }

    /**
     * @return $this
     */
    public function positionAfterTitle(): Location
    {
        return $this->position('acf_after_title');
    }

    /**
     * @return $this
     */
    public function positionBelow(): Location
    {
        return $this->position('normal');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function style(string $value): Location
    {
        if ( in_array( $value, [ 'default', 'seamless' ] ) ) {
            $this->style = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function styleWithBox(): Location
    {
        return $this->style('default');
    }

    /**
     * @return $this
     */
    public function styleWithoutBox(): Location
    {
        return $this->style('seamless');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function labelsOn(string $value): Location
    {
        if ( in_array( $value, [ 'top', 'left' ] ) ) {
            $this->labelPlacement = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function labelsAboveFields(): Location
    {
        return $this->labelsOn('top');
    }

    /**
     * @return $this
     */
    public function labelsBesideFields(): Location
    {
        return $this->labelsOn('left');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function instructionsBelow(string $value): Location
    {
        if ( in_array( $value, [ 'label', 'field' ] ) ) {
            $this->instructionPlacement = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function instructionsBelowLabels(): Location
    {
        return $this->instructionsBelow('label');
    }

    /**
     * @return $this
     */
    public function instructionsBelowFields(): Location
    {
        return $this->instructionsBelow('field');
    }

    /**
     * @param ...$elements
     * @return $this
     */
    public function hideOnScreen(...$elements): Location
    {
        $this->hideOnScreen = $elements;

        return $this;
    }

    /**
     * @param ...$except
     * @return Location
     */
    public function hideAll(...$except): Location
    {
        return $this->hideOnScreen( ...array_diff( [
            'permalink',
            'the_content',
            'excerpt',
            'discussion',
            'comments',
            'revisions',
            'slug',
            'author',
            'format',
            'featured_image',
            'categories',
            'tags',
            'send-trackbacks',
        ], $except ) );
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function enable(bool $value = true): Location
    {
        $this->active = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function disable(): Location
    {
        return $this->enable( false );
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function showInApi(bool $value = true): Location
    {
        $this->showInApi = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function hideInApi(): Location
    {
        return $this->showInApi( false );
    }

    /**
     * @param string $value
     * @return $this
     */
    public function description(string $value): Location
    {
        $this->description = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function page(int $value, string $boolean = 'and'): Location
    {
        return $this->showIf('page', '==', $value, $boolean );
    }

    /**
     * @param int $value
     * @param string $boolean
     * @return $this
     */
    public function pageParent(int $value, string $boolean = 'and'): Location
    {
        return $this->showIf('page_parent', '==', $value, $boolean );
    }

    /**
     * @param string $value
     * @param string $boolean
     * @return $this
     */
    public function pageTemplate(string $value, string $boolean = 'and'): Location
    {
        return $this->showIf('page_template', '==', $value, $boolean );
    }

    /**
     * @param int $value
     * @param string $boolean
     * @return $this
     */
    public function post(int $value, string $boolean = 'and'): Location
    {
        return $this->showIf('post', '==', $value, $boolean );
    }

    /**
     * @param string $value
     * @param string $boolean
     * @return $this
     */
    public function postType(string $value, string $boolean = 'and'): Location
    {
        return $this->showIf('post_type', '==', $value, $boolean );
    }

    /**
     * @param string $value
     * @param string $boolean
     * @return $this
     */
    public function postCategory(string $value, string $boolean = 'and'): Location
    {
        return $this->showIf('post_category', '==', $value, $boolean );
    }

    /**
     * @param string $value
     * @param string $boolean
     * @return $this
     */
    public function postTaxonomy(string $value, string $boolean = 'and'): Location
    {
        return $this->showIf('post_taxonomy', '==', $value, $boolean );
    }

    /**
     * @param string $value
     * @param string $boolean
     * @return $this
     */
    public function postFormat(string $value = 'standard', string $boolean = 'and'): Location
    {
        return $this->showIf('post_format', '==', $value, $boolean );
    }

    /**
     * @param string $value
     * @param string $boolean
     * @return $this
     */
    public function postStatus(string $value = 'publish', string $boolean = 'and'): Location
    {
        return $this->showIf('post_status', '==', $value, $boolean );
    }

    /**
     * @param string $value
     * @param string $boolean
     * @return $this
     */
    public function menu(string $value = 'all', string $boolean = 'and'): Location
    {
        return $this->showIf('nav_menu', '==', $value, $boolean );
    }

    /**
     * @param string $value
     * @param string $boolean
     * @return $this
     */
    public function menuItem(string $value = 'all', string $boolean = 'and'): Location
    {
        return $this->showIf('nav_menu_item', '==', $value, $boolean );
    }

    /**
     * @param string $value
     * @param string $boolean
     * @return $this
     */
    public function widget(string $value = 'all', string $boolean = 'and'): Location
    {
        return $this->showIf('widget', '==', $value, $boolean );
    }

    /**
     * @param string $value
     * @param string $boolean
     * @return $this
     */
    public function userRole(string $value = 'administrator', string $boolean = 'and'): Location
    {
        return $this->showIf('current_user_role', '==', $value, $boolean );
    }

    /**
     * @param string $value
     * @param string $boolean
     * @return $this
     */
    public function optionsPage(string $value = 'acf-options-common', string $boolean = 'and'): Location
    {
        return $this->showIf('options_page', '==', $value, $boolean );
    }

    /**
     * Build and initialise the group
     */
    public function build(): void
    {
        if ( function_exists('acf_add_local_field_group') ) {
            acf_add_local_field_group( $this->toArray() );
        }
    }

    /**
     * @return array
     */
    public function toArray():array
    {
        return array_merge( [
            'key' => $this->key,
            'title' => $this->name,
            'fields' => array_map( function (Field $field) {
                return $field->toArray();
            }, $this->fields ),
            'location' => $this->location,
            'menu_order' => $this->menuOrder,
            'position' => $this->position,
            'style' => $this->style,
            'label_placement' => $this->labelPlacement,
            'instruction_placement' => $this->instructionPlacement,
            'hide_on_screen' => $this->hideOnScreen,
        ], Builder::getFieldConfig( Builder::location ) );
    }
}