<?php
if ($_GET) {
	var_dump($_GET);
}
if ($_POST) {
	var_dump($_POST);
} 
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="CSS/todo_style.css">
	<title> TODO List</title>
</head>
<body>
	<h2>TODO List</h2>
	<ul>
		<li>Get Milk</li>
		<li>Pick up kids</li>
		<li>Water plants</li>
	</ul>
	<h2>Enter Item</h2>
	<form method="POST" action="/todo_list.php">
		<label for="newitem">New Item</label>
		<input type="text" id="newitem" name="newitem" placeholder="Enter Item">
		<input type="submit" value="add">
	</form>
	</body>
</html>