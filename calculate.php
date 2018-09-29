<?php
session_start();

require 'includes/helpers.php';

# Get data from form.
$principal = $_GET['principal'];
$interestRate = $_GET['interest'];
$payment = $_GET['payment'];
$cycle = $_GET['paymentCycle'];
$display = isset($_GET['display']);

$interestRate = convertInterest($interestRate);

# calculate Interest Rate Factor
$intRateFactor = getInterestFactor($interestRate);

# Total Interest paid
$int_paid = 0;

# Total number of payment periods
$payCycles = 0;

# Array to hold values of payment schedule
$paymentSchedule = [];

# Get payment period term
$termLength = paymentPeriodDuration($cycle);

while ($principal > $payment) {
    # At the start of the cycle, calculate 30 days of interest and add to principal
    # $simple_daily_int = $principal * $intRateFactor;
    # Interest to add equals simple daily interest * days since last payment (30)
    # $int_to_add = $simple_daily_int * $termLength;
    $interest = interestPerCycle($principal, $intRateFactor, $termLength);
    # Add interest to principal amount.
    $principal += $interest;
    # Add interest to total interest paid
    $int_paid += $interest;
    # Apply monthly payment to principal
    $principal -= $payment;
    # Count payment periods
    ++$payCycles;
    $paymentSchedule[] = round($principal, 2);
}

# Calculate final period of interest and finish paying off loan.
# $simple_daily_int = $principal * $intRateFactor;
# $interest = $simple_daily_int * $termLength;
$interest = interestPerCycle($principal, $intRateFactor, $termLength);
# Add interest to principal amount.
$principal += $interest;
# Add interest to total interest paid
$int_paid += $interest;
# Apply monthly payment to principal
$principal -= $principal;
# Count payment periods
++$payCycles;
$paymentSchedule[] = round($principal,  2);

$duration = formatAsYears($payCycles, $termLength);

# 'remainder' is the amount of principal that is left after payments have been applied

if ($display == 'true') {
    $_SESSION['result'] = [
        'int_paid' => $int_paid,
        'payment_periods' => $duration,
        'paymentSchedule' => $paymentSchedule
    ];
}
else {
    $_SESSION['result'] = [
        'int_paid' => $int_paid,
        'payment_periods' => $duration
    ];
}



header('Location: index.php');

