<?php

use Illuminate\Validation\Rules\Exists;

if (!function_exists('rupiah_format')) {
    function rupiah_format($nominal, $rp_prefix = true){
        if($rp_prefix) {
            return 'RP ' . number_format($nominal, 0, ",", ".");
        }
        return number_format($nominal, 0, ",", ".");
    }
}

if(!function_exists('split_name')) {
    function split_name($name) {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );
        return array($first_name, $last_name);
    }
}
