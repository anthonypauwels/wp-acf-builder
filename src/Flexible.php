<?php
namespace Anthonypauwels\WpAcfBuilder;

use Closure;
use Anthonypauwels\WpAcfBuilder\Concerns\Button;
use Anthonypauwels\WpAcfBuilder\Concerns\MinMax;
use Anthonypauwels\WpAcfBuilder\Contracts\Field;

/**
 * Class Flexible
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
class Flexible extends AbstractGroup implements Field
{
    use Button, MinMax;

    /** @var Layout[] */
    protected array $layouts = [];

    /**
     * @param callable $callback
     * @return $this
     */
    public function onLayoutTitle(callable $callback): Flexible
    {
        add_filter('acf/fields/flexible_content/layout_title/key=' . $this->key, $callback, 10, 4 );

        return $this;
    }

    /**
     * @param string $label
     * @param Closure $closure
     * @param string|null $name
     * @param string|null $key
     * @return Layout
     */
    public function layout(string $label, Closure $closure, string|null $name = null, string|null $key = null): Layout
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $layout = new Layout( $label, $name, $this->key . '_' . $key );

        $this->addLayout( $layout );

        $closure( $layout );

        return $layout;
    }

    /**
     * @param Layout $layout
     * @return $this
     */
    public function addLayout(Layout $layout): Flexible
    {
        $this->layouts[] = $layout;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Builder::flexible, [
            'layouts' => array_map( function (Layout $layout) {
	            return $layout->toArray();
            }, $this->layouts ),
            'button_label' => $this->button,
            'min' => $this->min,
            'max' => $this->max,
        ] );
    }
}