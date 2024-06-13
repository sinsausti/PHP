<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $operation = $_POST['operation'];
    $x = floatval($_POST['x']);
    $result = null;

    if (isset($_POST['y'])) {
        $y = floatval($_POST['y']);
    }

    switch ($operation) {
        case 'add':
            $result = $x + $y;
            break;
        case 'subtract':
            $result = $x - $y;
            break;
        case 'multiply':
            $result = $x * $y;
            break;
        case 'divide':
            $result = $x / $y;
            break;
        case 'pow':
            $result = pow($x, $y);
            break;
        case 'sin':
            $result = sin(deg2rad($x));
            break;
        case 'cos':
            $result = cos(deg2rad($x));
            break;
        case 'tan':
            $result = tan(deg2rad($x));
            break;
        case 'log':
            $result = log($x);
            break;
        case 'exp':
            $result = exp($x);
            break;
        default:
            $result = 'Invalid operation';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scientific Calculator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Scientific Calculator</h1>
        <form method="POST">
            <div class="form-group">
                <label for="operation">Operation</label>
                <select class="form-control" id="operation" name="operation" onchange="showInputs()" required>
                    <option value="add">Add</option>
                    <option value="subtract">Subtract</option>
                    <option value="multiply">Multiply</option>
                    <option value="divide">Divide</option>
                    <option value="pow">Power</option>
                    <option value="sin">Sine</option>
                    <option value="cos">Cosine</option>
                    <option value="tan">Tangent</option>
                    <option value="log">Logarithm</option>
                    <option value="exp">Exponential</option>
                </select>
            </div>
            <div id="calculator-inputs">
                <div class="form-group">
                    <label for="x">Number</label>
                    <input type="number" step="any" class="form-control" id="x" name="x" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>
        <?php if (isset($result)): ?>
            <div class="alert alert-info mt-3">
                <?= htmlspecialchars($result) ?>
            </div>
        <?php endif; ?>
    </div>
    <script>
        function showInputs() {
            const operation = document.getElementById('operation').value;
            const inputsDiv = document.getElementById('calculator-inputs');
            if (['add', 'subtract', 'multiply', 'divide', 'pow'].includes(operation)) {
                inputsDiv.innerHTML = `
                    <div class="form-group">
                        <label for="x">First Number</label>
                        <input type="number" step="any" class="form-control" id="x" name="x" required>
                    </div>
                    <div class="form-group">
                        <label for="y">Second Number</label>
                        <input type="number" step="any" class="form-control" id="y" name="y" required>
                    </div>
                `;
            } else {
                inputsDiv.innerHTML = `
                    <div class="form-group">
                        <label for="x">Number</label>
                        <input type="number" step="any" class="form-control" id="x" name="x" required>
                    </div>
                `;
            }
        }
    </script>
</body>
</html>