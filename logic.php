<?php
session_start();

if(isset($_SESSION['result'])) {
    $payment_periods = $_SESSION['result'];
}

session_unset();

