<?php
require 'includes/logic.php';
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Loan Planner</title>
    <!-- https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meta -->
    <meta charset='utf-8'/>
    <meta content='initial-scale=1, width = device-width' name='viewport'/>
    <link rel='stylesheet'
          href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'
          integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm'
          crossorigin='anonymous'>
    <link href='/styles/app.css' rel='stylesheet'>
</head>
<body>
<main class='container'>
    <h1>Loan Map</h1>
    <p>Use this interest calculator to help you optimize loan payments.</p>
    <section id='formInput'>
        <form method='GET' action='includes/calculate.php'>
            <h2>Loan Details</h2>
            <fieldset>
                <legend>Required fields are followed by <strong><abbr title='required'>*</abbr></strong></legend>
                <label for='principal'>
                    Principal Remaining ($)
                    <strong><abbr title='required'>*</abbr></strong>
                </label>
                <input type='number'
                       autofocus id='principal' name='principal' step='.01' value='<?= $principal ?? '' ?>'>
                <label for='interest'>
                    Interest (%)
                    <strong><abbr title='required'>*</abbr></strong>
                </label>
                <input type='number'
                       id='interest' name='interest' step='.001' value='<?= $interest ?? '' ?>'>
                <label for='payment'>
                    Payment Amount ($)
                    <strong><abbr title='required'>*</abbr></strong>
                </label>
                <input type='number'
                       id='payment' name='payment' step='.01' value='<?= $payment ?? '' ?>'>
                <label for='paymentCycle'>
                    Payment Frequency
                </label>
                <select name='paymentCycle' id='paymentCycle'>
                    <option value='select'>Select Length</option>
                    <option value='thirty'
                        <?php if (isset($paymentCycle) and $paymentCycle == 'thirty') echo 'selected' ?>>
                        Thirty days
                    </option>
                    <option value='sixty'
                        <?php if (isset ($paymentCycle) and $paymentCycle == 'sixty') echo 'selected' ?>>
                        Sixty days
                    </option>
                    <option value='ninety'
                        <?php if (isset ($paymentCycle) and $paymentCycle == 'ninety') echo 'selected' ?>>
                        Ninety days
                    </option>
                </select>
                <label for='display' id="checkDisplay">
                    <input type='checkbox' name='display'
                           id='display' <?php if (isset($display) and $display) echo 'checked' ?>>
                    Display Payment Schedule
                </label>
            </fieldset>
            <input type='submit' value='Calculate'>
            <?php if ($hasErrors): ?>
                <div class='errors alert alert-danger'>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif ?>
        </form>
    </section>
    <?php if (!$hasErrors): ?>
        <?php if (isset($interestPaid)): ?>
            <p class='alert alert-success'>
                Total Interest Paid: $<?= $interestPaid ?>
            </p>
        <?php endif ?>
        <?php if (isset($duration)): ?>
            <p class='alert alert-primary'>
                Time to pay off: <?= $duration ?> year(s)
            </p>
        <?php endif ?>
        <?php if (isset($paymentSchedule) and $paymentSchedule != null): ?>
            <table>
                <?php foreach ($paymentSchedule as $index => $payment): ?>
                    <?php if ($index == 0): ?>
                        <tr>
                        <td>$<?= $payment ?></td>
                    <?php elseif (isset($rowBreak) and $index % $rowBreak == 0): ?>
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
    <?php endif; ?>
</main>
</body>
</html>

