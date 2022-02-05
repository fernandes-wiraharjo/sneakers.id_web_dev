<?php

if (!function_exists('rupiah_format')) {
    function rupiah_format($nominal){
        return number_format($nominal, 0, ",", ".");
    }
}
