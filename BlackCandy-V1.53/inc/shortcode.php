<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 11/11/2016
 * Time: 18:31
 */

function warningbox($atts, $content=null, $code="") {
    $return = '<div class="warning shortcodestyle">';
    $return .= $content;
    $return .= '</div>';
    return $return;
}
add_shortcode('warning' , 'warningbox' );
add_action( 'init', 'warningbox');