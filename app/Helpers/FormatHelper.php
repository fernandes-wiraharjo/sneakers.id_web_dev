<?php

use Illuminate\Validation\Rules\Exists;

if (!function_exists('rupiah_format')) {
    function rupiah_format($nominal, $rp_prefix = false){
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

if (! function_exists('shipping_location')) {
    function shipping_location($model): array
    {
        return \App\Support\ShippingLocation::resolve($model);
    }
}

if (! function_exists('search_normalize_chars')) {
    /**
     * Characters ignored when matching search keywords (apostrophes + dash variants).
     */
    function search_normalize_chars(): array
    {
        return ["'", "’", '-', '–', '—'];
    }
}

if (! function_exists('normalize_search_term')) {
    /**
     * Normalize a search string the same way SQL column values are normalized.
     */
    function normalize_search_term(string $value): string
    {
        return str_replace(search_normalize_chars(), '', $value);
    }
}

if (! function_exists('sql_normalized_search_column')) {
    /**
     * Build a SQL expression that strips search-noise characters from a column.
     */
    function sql_normalized_search_column(string $column): string
    {
        if (! preg_match('/^[A-Za-z0-9_.]+$/', $column)) {
            throw new \InvalidArgumentException('Invalid column for search normalization.');
        }

        $expression = "`{$column}`";

        foreach (search_normalize_chars() as $char) {
            $sqlChar = "'" . str_replace("'", "''", $char) . "'";
            $expression = "REPLACE({$expression}, {$sqlChar}, '')";
        }

        return $expression;
    }
}
