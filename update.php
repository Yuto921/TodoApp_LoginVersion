<?php
require_once('Models/Todo.php');

$id = $_POST['id'];
$task = $_POST['task'];

// echo $id;
// echo $task;

$update = new Todo();

$update->update($task, $id);

header('Location: index.php');
exit();