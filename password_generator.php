<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $length = intval($_POST['length']);
    $use_uppercase = isset($_POST['use_uppercase']);
    $use_digits = isset($_POST['use_digits']);
    $use_symbols = isset($_POST['use_symbols']);

    $lower = 'abcdefghijklmnopqrstuvwxyz';
    $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $digits = '0123456789';
    $symbols = '!@#$%^&*()-_=+[]{}|;:,.<>?';
    $char_set = $lower;
    if ($use_uppercase) $char_set .= $upper;
    if ($use_digits) $char_set .= $digits;
    if ($use_symbols) $char_set .= $symbols;

    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $char_set[random_int(0, strlen($char_set) - 1)];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Generator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Password Generator</h1>
        <form method="POST">
            <div class="form-group">
                <label for="length">Length</label>
                <input type="number" id="length" name="length" class="form-control" value="12" required>
            </div>
            <div class="form-check">
                <input type="checkbox" id="use_uppercase" name="use_uppercase" class="form-check-input">
                <label class="form-check-label" for="use_uppercase"> Include Uppercase</label>
            </div>
            <div class="form-check">
                <input type="checkbox" id="use_digits" name="use_digits" class="form-check-input">
                <label class="form-check-label" for="use_digits"> Include Digits</label>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" id="use_symbols" name="use_symbols" class="form-check-input">
                <label class="form-check-label" for="use_symbols"> Include Symbols</label>
            </div>
            <button class="btn btn-primary" type="submit">Generate Password</button>
        </form>
        <?php if (isset($password)): ?>
            <div class="alert alert-info mt-3">
                Generated password: <?= htmlspecialchars($password) ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
