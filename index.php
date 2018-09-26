<?php
require 'logic.php';
?>
<html lang = "en">
<head>
    <!-- https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meta -->
    <meta charset = "utf-8"/>
    <meta content = "initial-scale=1, width = device-width" name = "viewport"/>
    <title>Loan Planner</title>
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
<?php if (isset($payment_periods)): ?>
    <p>
        Total Payment periods: <?= $payment_periods ?>
    </p>
<?php endif ?>

</body>
</html>

