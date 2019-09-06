<?php

require_once('Models/Todo.php');

$id = $_GET['id'];

$delete = new Todo;

$delete->delete($id);

header('Location: index.php');
exit();
