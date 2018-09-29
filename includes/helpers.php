<?php

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

