<?php
namespace Anthonypauwels\WpAcfBuilder\Contracts;

interface Field
{
    /**
     * @return array
     */
    function toArray():array;
}