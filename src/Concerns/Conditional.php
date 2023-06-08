<?php
namespace Anthonypauwels\WpAcfBuilder\Concerns;

trait Conditional
{
    /** @var array */
    protected array $conditionalLogic = [];

    /**
     * @param string $param
     * @param string $operator
     * @param string|null $value
     * @param string $boolean
     * @return $this
     */
    public function showIf(string $param, string $operator, string $value = null, string $boolean = 'and'): self
    {
        if ( func_num_args() === 2 ) {
            $value = $operator;
            $operator = '==';
        }

        if ( !in_array( $operator, [ '==', '!=' ] ) ) {
            $operator = '==';
        }

        if ( !in_array( $boolean, [ 'and', 'or' ] ) ) {
            $boolean = 'and';
        }

        $conditional = compact('param', 'operator', 'value');

        if ( $boolean === 'and' ) {
            $last = array_key_last( $this->conditionalLogic );

            if ( $last !== null ) {
                $this->conditionalLogic[ $last ][] = $conditional;
            } else {
                $this->conditionalLogic[] = [
                    $conditional
                ];
            }
        }

        if ( $boolean === 'or' ) {
            $this->conditionalLogic[] = [
                $conditional
            ];
        }

        return $this;
    }

    /**
     * @param string $param
     * @param string $operator
     * @param string|null $value
     * @return $this
     */
    public function andShowIf(string $param, string $operator, string $value = null): self
    {
        return $this->showIf( $param, $operator, $value );
    }

    /**
     * @param string $param
     * @param string $operator
     * @param string|null $value
     * @return $this
     */
    public function orShowIf(string $param, string $operator, string $value = null): self
    {
        return $this->showIf( $param, $operator, $value, 'or' );
    }
}