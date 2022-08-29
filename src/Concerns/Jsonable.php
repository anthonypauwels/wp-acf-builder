<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait Jsonable
{
    /**
     * @return array
     */
    abstract public function toArray():array;

    /**
     * @return false|string
     */
    public function toJson(): bool|string
    {
        return json_encode( $this->toArray() );
    }
}