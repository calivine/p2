<?php
session_start();

# Get principal loan amount from form.
$principal = $_GET['principal'];
$interest = $_GET['interest'];




$_SESSION['result'] = $principal;

header('Location: index.php');

