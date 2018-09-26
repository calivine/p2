<?php

function get_int_factor($interest)
{
    $rate = $interest / 365;
    return $rate;
}

