<?php

# Total Interest paid
$interestPaid = 0;

# Total number of payment periods
$payCycles = 0;

# Array to hold values of payment schedule
$paymentSchedule = [];



function convertInterest($interest)
{
    $converted = $interest * .01;
    return $converted;
}

function getInterestFactor($interest)
{
    $rate = $interest / 365;
    return $rate;
}

function interestPerCycle($principal, $intRateFactor, $termLength)
{
    # At the start of the cycle, calculate 30 days of interest and add to principal
    $simple_daily_int = $principal * $intRateFactor;
    # Interest to add equals simple daily interest * days since last payment (30)
    $int_to_add = $simple_daily_int * $termLength;
    return $int_to_add;
}

function paymentPeriodDuration($cycle)
{
    if ($cycle == 'thirty') {
        $paymentTerm = 30;
    }
    else if ($cycle == 'sixty') {
        $paymentTerm = 60;
    }
    else if ($cycle == 'ninety') {
        $paymentTerm = 90;
    }
    else {
        $paymentTerm = 30; # Default if option is not chosen.
    }
    return $paymentTerm;
}

function formatAsYears($paymentPeriods, $paymentTerm)
{
    $days = $paymentPeriods * $paymentTerm;
    $years = round($days / 365, 1);
    return $years;
}

/**
 * Utility function to quickly dump data to the page
 * @param null $mixed
 */
function dump($mixed = null)
{
    echo '<pre>';
    var_dump($mixed);
    echo '</pre>';
}
/**
 * Recursively escape HTML entities
 * @param null $mixed
 * @return array|string
 */
function sanitize($mixed = null)
{
    if (!is_array($mixed)) {
        return convertHtmlEntities($mixed);
    }
    function array_map_recursive($callback, $array)
    {
        $func = function ($item) use (&$func, &$callback) {
            return is_array($item) ? array_map($func, $item) : call_user_func($callback, $item);
        };
        return array_map($func, $array);
    }
    return array_map_recursive('convertHtmlEntities', $mixed);
}
/**
 * Escape HTML entities in the given String $str
 * @param $str
 * @return string
 */
function convertHtmlEntities($str)
{
    return htmlentities($str, ENT_QUOTES, "UTF-8");
}