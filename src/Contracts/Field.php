<?php
namespace Anthonypauwels\WpAcfBuilder\Contracts;

/**
 * Interface Field
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
interface Field
{
    /**
     * @return array
     */
    function toArray():array;
}