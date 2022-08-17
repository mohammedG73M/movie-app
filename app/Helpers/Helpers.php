<?php

/**
 * Converts date to M d, Y
 *
 * @return response()
 */

use Carbon\Carbon;

if (! function_exists('parseDateToMdY')) {
    function parseDateToMdY($date): string
    {
        return Carbon::parse($date)->format('M d, Y');
    }
}
