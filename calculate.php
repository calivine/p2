<?php
session_start();

require 'includes/helpers.php';

# Get data from form.
$principal = $_GET['principal'];
$int_rate = $_GET['interest'];
$payment = $_GET['payment'];

# calculate Interest Rate Factor
$int_rate_factor = get_int_factor($int_rate);

# Total Interest paid
$int_paid = 0;

# Total number of payment periods
$payment_periods = 0;

while ($principal > 0) {
    # At the start of the cycle, calculate 30 days of interest and add to principal
    $simple_daily_int = $principal * $int_rate_factor;
    # Interest to add equals simple daily interest * days since last payment (30)
    $int_to_add = $simple_daily_int * 30;
    # Add interest to principal amount.
    $principal += $int_to_add;
    # Add interest to total interest paid
    $int_paid += $int_to_add;
    # Apply monthly payment to principal
    $principal -= $payment;
    # Count payment periods
    ++$payment_periods;
}

# 'remainder' is the amount of principal that is left after payments have been applied
$_SESSION['result'] = [
    'int_paid' => $int_paid,
    'payment_periods' => $payment_periods,
    'remainder' => $principal
];


header('Location: index.php');

