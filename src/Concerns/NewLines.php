<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\MessageField;
use Anthonypauwels\WpAcfBuilder\Fields\TextareaField;

/**
 * Class NewLines
 *
 * @package Anthonypauwels\WpAcfBuilder
 * @author Anthony Pauwels <hello@anthonypauwels.be>
 */
trait NewLines
{
    /** @var string */
    protected string $newLines = 'wpautop';

    /**
     * @param string $value
     * @return MessageField|NewLines|TextareaField
     */
    public function newLines(string $value): self
    {
        if ( !in_array( $value, ['wpautop', 'br', ''] ) ) {
            $value = 'wpautop';
        }

        $this->newLines = $value;

        return $this;
    }

    /**
     * @return MessageField|NewLines|TextareaField
     */
    public function paragraphs(): self
    {
        return $this->newLines( 'wpautop' );
    }

    /**
     * @return MessageField|NewLines|TextareaField
     */
    public function breakLines(): self
    {
        return $this->newLines( 'br' );
    }

    /**
     * @return MessageField|NewLines|TextareaField
     */
    public function noFormatting(): self
    {
        return $this->newLines( '' );
    }
}