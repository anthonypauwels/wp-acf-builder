<?php
if ( !function_exists( 'wp_acf_builder_slugify' ) ) {
    /**
     * @param string $value
     * @return string
     */
    function wp_acf_builder_slugify(string $value):string
    {
        $old_locale = setlocale( LC_ALL, '0' );
        setlocale(LC_ALL, 'en_US.UTF-8' );

        if ( function_exists( 'iconv' ) ) {
            $value = iconv( 'UTF-8', 'ASCII//TRANSLIT', $value );
        }

        $value = preg_replace( "/[^a-zA-Z0-9\/_|+ -]/", '', $value );
        $value = strtolower( $value );
        $value = preg_replace("/[\/_|+ -]+/", '_', $value );
        $value = trim( $value, '_');

        setlocale( LC_ALL, $old_locale );

        return $value;
    }
}