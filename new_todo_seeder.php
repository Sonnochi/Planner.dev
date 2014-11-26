<?php

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'todo_db');
define('DB_USER', 'todo_sayo');
define('DB_PASS', 'charlie3');

require 'inc/db_connect.php';

echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

$things=[
    ['content' => 'Water plants'],
    ['content' => 'Feed cat'],
    ['content' => 'Take out trash']
];

$query = "INSERT INTO items (content) VALUES (:content)";

$stmt = $dbc->prepare($query);

foreach ($things as $thing){
    $stmt->bindValue(':content', $thing['content'], PDO::PARAM_STR);
    
    $stmt->execute();
}
