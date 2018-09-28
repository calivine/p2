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
    <link href='/styles/app.css' rel='stylesheet'>
</head>
<body>
<main class="container">
    <h1>Loan Map</h1>
    <p>This tool helps users plan loan payments. Fill out the form below and press submit.</p>
    <div class="row">
        <section class="col-5">
            <form method="GET" action="calculate.php">
                <fieldset>
                    <legend>Loan Details</legend>
                    <label>
                        Remaining Principal Amount
                        <input type="number" name="principal" placeholder="$">
                    </label>
                    <label>
                        Interest Rate
                        <input type="number" name="interest" step=".001" placeholder="i.e. .001">
                    </label>
                    <label>
                        Payment Amount
                        <input type="number" name="payment" placeholder="$">
                    </label>
                    <label>
                        Payment Cycle Duration
                        <select name="paymentCycle">
                            <option value="select">Select length</option>
                            <option value="thirty">Thirty days</option>
                            <option value="sixty">Sixty days</option>
                            <option value="ninety">Ninety days</option>
                        </select>
                    </label>
                    <label id="checkbox-display">
                        Display Payment Schedule
                        <input type='checkbox' name='display'>
                    </label><br>
                    <input type="submit" value="Calculate">
                </fieldset>
            </form>
        </section>
        <section class="col-6 offset-1">
            <?php if (isset($int_paid)): ?>
                <p>
                    Total Interest Paid: $<?= $int_paid ?>
                </p>
            <?php endif ?>
            <?php if (isset($payment_periods)): ?>
                <p>
                    Payment periods: <?= $payment_periods ?>
                </p>
            <?php endif ?>
        </section>
    </div>
</main>
</body>
</html>

