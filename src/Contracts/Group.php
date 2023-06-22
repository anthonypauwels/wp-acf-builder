<?php
namespace Anthonypauwels\WpAcfBuilder\Contracts;

/**
 * Interface Group
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
interface Group
{
    /**
     * @return array
     */
    function toArray():array;
}