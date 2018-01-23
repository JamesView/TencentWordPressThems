<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 11/5/2016
 * Time: 23:34
 */

class CCWalker extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        if ($depth == 0) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"sub-menu child-menu depth_$depth \">\n";
        } else if($depth == 1) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"sub-menu grand-menu depth_$depth \">\n";
        } else {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"sub-menu descendant-menu depth_$depth \">\n";
        }

    }
}