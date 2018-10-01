<?php
session_start();

$hasErrors = false;

if (isset($_SESSION['result'])) {
    $results = $_SESSION['result'];

    $paymentCycle = $results['paymentCycle'];
    $display = $results['display'];
    $interest = $results['interest'];
    $interestPaid = round($results['interestPaid'], 2);
    $payment = $results['payment'];
    $duration = $results['duration'];
    $paymentSchedule = $results['paymentSchedule'];
    $principal = $results['principal'];
    $errors = $results['errors'];
    $hasErrors = $results['hasErrors'];
}

session_unset();

