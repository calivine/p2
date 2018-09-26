<?php
require 'logic.php';
?>
<html lang="en">
<head>
    <title>Loan Planner</title>
    <!-- https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meta -->
    <meta charset="utf-8"/>
    <meta content="initial-scale=1, width = device-width" name="viewport"/>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
</head>
<body>
<h1>Loan Planning Assistant</h1>
<p>This tool helps users plan loan payments. Fill out the form below and press submit.</p>
<form method="GET" action="calculate.php">
    <input type="number" name="principal" placeholder="Principal amount">
    <input type="number" name="interest" step=".001" placeholder="Interest Rate">
    <input type="number" name="payment" placeholder="Monthly Payment">
    <input type="submit" value="Calculate">
</form>
<?php if (isset($int_paid)): ?>
    <p>
        Total Interest Paid: <?= $int_paid ?>
    </p>
<?php endif ?>
<?php if (isset($payment_periods)): ?>
    <p>
        Payment periods: <?= $payment_periods ?>
    </p>
<?php endif ?>

</body>
</html>

