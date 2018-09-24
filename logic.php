<?php
session_start();

if(isset($_SESSION['result'])) {
    $principal = $_SESSION['result'];
}

session_unset();

