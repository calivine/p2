<?php
require 'includes/helpers.php';
require 'Form.php';

use AC\Form;

# Initiate session
session_start();

# Instantiate new form object
$form = new Form($_GET);

# Get form data
$principal = $form->get('principal');
$interest = $form->get('interest');
$payment = $form->get('payment');
$paymentCycle = $form->get('paymentCycle') ?? null;
$display = $form->has('display');

# Validate the form data
$errors = $form->validate([
    'principal' => 'required|numeric|min:0',
    'interest' => 'required|numeric|min:0',
    'payment' => 'required|numeric|min:0',
]);

if (!$form->hasErrors) {
    # Convert interest rate to decimal form
    $interestRate = convertInterest($interest);

    # Interest Rate Factor
    $intRateFactor = getInterestFactor($interestRate);

    # Convert input to integer
    $termLength = paymentFrequency($paymentCycle);

    # Variable to tracking principal as it is paid off.
    $remainingPrincipal = $principal;

    $paymentSchedule[] = $remainingPrincipal;

    while ($remainingPrincipal > $payment) {
        # Calculate interest for pay cycle
        $interestPayment = interestPerCycle($remainingPrincipal, $intRateFactor, $termLength);
        # Add interest to principal amount and apply payment
        $remainingPrincipal += $interestPayment;
        $remainingPrincipal -= $payment;
        # Track total interest paid
        $interestPaid += $interestPayment;
        # Count payment periods
        ++$payCycles;
        # Track progress, add remaining balance to array
        $paymentSchedule[] = round($remainingPrincipal, 2);
    }
    /*
     * Payoff remainder of loan by going through
     * process a final time.  */
    $interestPayment = interestPerCycle($remainingPrincipal, $intRateFactor, $termLength);
    # Add interest to principal amount.
    $remainingPrincipal += $interestPayment;
    # Apply monthly payment to principal
    $remainingPrincipal -= $remainingPrincipal;
    # Track total interest paid
    $interestPaid += $interestPayment;
    # Count payment periods
    ++$payCycles;
    $paymentSchedule[] = round($remainingPrincipal, 2);
    # Format payment periods into years
    $duration = formatAsYears($payCycles, $termLength);
}

$_SESSION['result'] = [
    'paymentCycle' => $paymentCycle,
    'display' => $display,
    'errors' => $errors,
    'hasErrors' => $form->hasErrors,
    'interest' => $interest,
    'interestPaid' => $interestPaid,
    'payment' => $payment,
    'duration' => $duration,
    'paymentSchedule' => $display == 'true' ? $paymentSchedule : null,
    'principal' => $principal,
];

header('Location: index.php');

