<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait NewLines
{
    /** @var string */
    protected string $newLines = 'wpautop';

    /**
     * @param string $value
     * @return $this
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
     * @return $this
     */
    public function paragraphs(): self
    {
        return $this->newLines( 'wpautop' );
    }

    /**
     * @return $this
     */
    public function breakLines(): self
    {
        return $this->newLines( 'br' );
    }

    /**
     * @return $this
     */
    public function noFormatting(): self
    {
        return $this->newLines( '' );
    }
}