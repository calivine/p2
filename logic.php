<?php
session_start();

if(isset($_SESSION['result'])) {
    $results = $_SESSION['result'];

    $int_paid = round($results['int_paid'], 2);
    $payment_periods = $results['payment_periods'];
    $principalRemaining = $results['remainder'];
    $paymentSchedule = $results['paymentSchedule'];
}

session_unset();

