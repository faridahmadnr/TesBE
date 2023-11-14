<?php

use Carbon\Carbon;

if (! function_exists('appName')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function appName()
    {
        return config('app.name', 'Kur Jogja');
    }
}

if (! function_exists('carbon')) {
    /**
     * Create a new Carbon instance from a time.
     *
     * @return Carbon
     *
     * @throws Exception
     */
    function carbon($time)
    {
        return new Carbon($time);
    }
}

if (! function_exists('formatCurrency')) {

    /**
     * Formats a number as currency.
     *
     * @param  float  $number The number to be formatted.
     * @return string The formatted currency string.
     */
    function formatCurrency($number)
    {
        return 'Rp '.number_format($number, 0, ',', '.');
    }
}
