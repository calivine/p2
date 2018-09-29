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
    <section>
        <form method="GET" action="calculate.php">
            <fieldset>
                <legend>Loan Details</legend>
                <label for="principal">Remaining Principal Amount</label>
                <input type="number" id="principal" name="principal" placeholder="$">
                <label for="interest">Interest Rate</label>
                <input type="number" id="interest" name="interest" step=".001">
                <label for="payment">Payment Amount</label>
                <input type="number" id="payment" name="payment" placeholder="$">
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
                    <input type='checkbox' name='display'>
                    Display Payment Schedule
                </label>
            </fieldset>
            <input type="submit" value="Calculate">
        </form>
    </section>
    <section class="col-7">
        <?php if (isset($interestPaid)): ?>
            <p>
                Total Interest Paid: $<?= $interestPaid ?>
            </p>
        <?php endif ?>
        <?php if (isset($payment_periods)): ?>
            <p>
                Time to pay off: <?= $payment_periods ?> year(s)
            </p>
        <?php endif ?>
    </section>
    <?php if (isset($paymentSchedule)): ?>
        <table>
            <?php foreach ($paymentSchedule as $index => $payment): ?>
                <?php if ($index == 0): ?>
                    <tr>
                    <td>$<?= $payment ?></td>
                <?php elseif ($index == 20 | $index == 40): ?>
                    <td>$<?= $payment ?></td>
                    </tr>
                    <tr>
                <?php elseif ($index == count($paymentSchedule) - 1): ?>
                    <td>$<?= $payment ?></td>
                    </tr>
                <?php else: ?>
                    <td>$<?= $payment ?></td>
                <?php endif ?>
            <?php endforeach ?>
        </table>
    <?php endif ?>
</main>
</body>
</html>

