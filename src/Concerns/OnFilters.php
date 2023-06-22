<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\AbstractGroup;
use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

/**
 * Class OnFilters
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait OnFilters
{
    /**
     * @param callable $callback
     * @return OnFilters|AbstractGroup|AbstractField
     */
    public function onLoad(callable $callback): self
    {
        add_filter('acf/load_field/key=' . $this->getKey(), $callback );

        return $this;
    }

    /**
     * @param callable $callback
     * @return OnFilters|AbstractGroup|AbstractField
     */
    public function onValue(callable $callback): self
    {
        add_filter('acf/load_value/key=' . $this->getKey(), $callback );

        return $this;
    }

    /**
     * @param callable $callback
     * @return OnFilters|AbstractGroup|AbstractField
     */
    public function onUpdate(callable $callback): self
    {
        add_filter('acf/update_field/key=' . $this->getKey(), $callback, 10, 3 );

        return $this;
    }

    /**
     * @param callable $callback
     * @return OnFilters|AbstractGroup|AbstractField
     */
    public function onFormat(callable $callback): self
    {
        add_filter('acf/format_value/key=' . $this->getKey(), $callback, 10, 3 );

        return $this;
    }
}