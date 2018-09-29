<?php
session_start();

require 'includes/helpers.php';
require 'Form.php';

use AC\Form;

$form = new Form($_GET);

# Get data from form.
$principal = $_GET['principal'];
$interestRate = $_GET['interest'];
$payment = $_GET['payment'];
$cycle = $_GET['paymentCycle'];
$display = isset($_GET['display']);



# Convert interest rate to decimal form
$interestRate = convertInterest($interestRate);

# calculate Interest Rate Factor
$intRateFactor = getInterestFactor($interestRate);

# Get payment period term
$termLength = paymentPeriodDuration($cycle);

while ($principal > $payment) {
    # Calculate interest for pay cycle
    $interest = interestPerCycle($principal, $intRateFactor, $termLength);
    # Add interest to principal amount and apply payment
    $principal += $interest;
    $principal -= $payment;
    # Track total interest paid
    $interestPaid += $interest;
    # Count payment periods
    ++$payCycles;
    # Track progress
    $paymentSchedule[] = round($principal, 2);
}

/*
 Payoff remainder of loan by going through
 process a final time.  */
$interest = interestPerCycle($principal, $intRateFactor, $termLength);
# Add interest to principal amount.
$principal += $interest;
# Apply monthly payment to principal
$principal -= $principal;
# Track total interest paid
$interestPaid += $interest;
# Count payment periods
++$payCycles;
$paymentSchedule[] = round($principal,  2);

# Format payment periods into years
$duration = formatAsYears($payCycles, $termLength);

/* Add to session data. If user selected display,
   Add payment schedule array to session data.
*/
if ($display == 'true') {
    $_SESSION['result'] = [
        'interestPaid' => $interestPaid,
        'payment_periods' => $duration,
        'paymentSchedule' => $paymentSchedule
    ];
}
else {
    $_SESSION['result'] = [
        'interestPaid' => $interestPaid,
        'payment_periods' => $duration
    ];
}



header('Location: index.php');

