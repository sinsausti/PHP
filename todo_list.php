<?php
session_start();

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['task'])) {
        $_SESSION['tasks'][] = ['description' => $_POST['task'], 'completed' => false];
    } elseif (isset($_POST['complete'])) {
        $_SESSION['tasks'][$_POST['complete']]['completed'] = true;
    } elseif (isset($_POST['delete'])) {
        array_splice($_SESSION['tasks'], $_POST['delete'], 1);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>To-Do List</h1>
        <form method="POST">
            <div class="input-group mb-3">
                <input type="text" id="task" name="task" class="form-control" placeholder="Enter a new task" required>
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit">Add Task</button>
                </div>
            </div>
        </form>
        <ul class="list-group">
            <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
                <li class="list-group-item <?= $task['completed'] ? 'completed' : '' ?>">
                    <?= htmlspecialchars($task['description']) ?>
                    <?php if (!$task['completed']): ?>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="complete" value="<?= $index ?>">
                            <button type="submit" class="btn btn-sm btn-primary ml-2">Complete</button>
                        </form>
                    <?php endif; ?>
                    <form method="POST" class="d-inline">
                        <input type="hidden" name="delete" value="<?= $index ?>">
                        <button type="submit" class="btn btn-sm btn-danger ml-2">Delete</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <style>
        .completed {
            text-decoration: line-through;
        }
    </style>
</body>
</html>