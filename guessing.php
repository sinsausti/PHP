<?php
session_start();

if (!isset($_SESSION['secret_number'])) {
    $_SESSION['secret_number'] = rand(1, 100);
    $_SESSION['attempts'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $guess = intval($_POST['guess']);
    $_SESSION['attempts']++;

    if ($guess < $_SESSION['secret_number']) {
        $message = "Too low, try again.";
    } elseif ($guess > $_SESSION['secret_number']) {
        $message = "Too high, try again.";
    } else {
        $message = "Congratulations! You guessed the number in {$_SESSION['attempts']} attempts.";
        session_destroy();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number Guessing Game</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Number Guessing Game</h1>
        <form method="POST">
            <div class="form-group">
                <label for="guess">Guess the number:</label>
                <input type="number" class="form-control" id="guess" name="guess" required>
            </div>
            <button type="submit" class="btn btn-primary">Guess</button>
        </form>
        <?php if (isset($message)): ?>
            <div class="alert alert-info mt-3">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>