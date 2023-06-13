<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait OnFilters
{
    /**
     * @param callable $callback
     * @return $this
     */
    public function onLoad(callable $callback): self
    {
        add_filter('acf/load_field/key=' . $this->getKey(), $callback );

        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function onValue(callable $callback): self
    {
        add_filter('acf/load_value/key=' . $this->getKey(), $callback );

        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function onUpdate(callable $callback): self
    {
        add_filter('acf/update_field/key=' . $this->getKey(), $callback, 10, 3 );

        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function onFormat(callable $callback): self
    {
        add_filter('acf/format_value/key=' . $this->getKey(), $callback, 10, 3 );

        return $this;
    }
}