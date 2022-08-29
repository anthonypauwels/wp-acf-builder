<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

use Anthonypauwels\WpAcfBuilder\Fields\AbstractField;

trait NewLines
{
    /** @var string */
    protected string $newLines = 'wpautop';

    /**
     * @param string $value
     * @return AbstractField
     */
    public function newLines(string $value): AbstractField
    {
        if ( !in_array( $value, ['wpautop', 'br', ''] ) ) {
            $value = 'wpautop';
        }

        $this->newLines = $value;

        return $this;
    }

    /**
     * @return AbstractField
     */
    public function paragraphs(): AbstractField
    {
        return $this->newLines( 'wpautop' );
    }

    /**
     * @return AbstractField
     */
    public function breakLines(): AbstractField
    {
        return $this->newLines( 'br' );
    }

    /**
     * @return AbstractField
     */
    public function noFormatting(): AbstractField
    {
        return $this->newLines( '' );
    }
}