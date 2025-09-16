<?php

use Spatie\Html\Html;

if (! function_exists('html')) {
    function html(): Html
    {
        static $html;

        if ($html === null) {
            $html = new Html();
        }

        return $html;
    }
}
