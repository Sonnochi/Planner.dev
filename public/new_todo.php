<?php

    define('DB_HOST', '127.0.0.1');
    define('DB_NAME', 'todo_db');
    define('DB_USER', 'todo_sayo');
    define('DB_PASS', 'charlie3');

    require '../inc/db_connect.php';

    if(isset($_GET['page'])){
        $pageNumber = $_GET['page'];
    } else{
        $pageNumber = 1;
    }
    
    $limit = 4;
    $offset = ($pageNumber - 1) * $limit;
    $query = "SELECT content FROM things LIMIT :limit OFFSET :offset";

    $stmt = $dbc->prepare($query);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $parks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $numberOfItems = $dbc->query('SELECT count(*) FROM things')->fetchColumn();
    
    if($_POST) {
    if(empty($_POST['content'])) {
         echo "<div class='alert alert-info' role='alert'> Please fill in all fields. </div>";
    } else {
        if(strlen($_POST['description'] < 125)) {
            $query = $dbc->prepare('INSERT INTO things (content) VALUES(:content)');
            $query->bindValue(':content', $_POST['content'], PDO:: PARAM_STR);
           
            $query->execute();
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>National Parks</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    </head>
    <body>
        <h1>National Parks</h1>
        <table class="table table-striped">
            <tr>
                <th>Content</th>
                
            </tr>
            
        <?php foreach ($things as $thing): ?>
            <tr>
                <td><?= $thing['content'] ?></td>
            </tr>
        <?php endforeach; ?>
        
        </table>
        
        <? if($pageNumber > 1): ?>
            <a href="?page=<?=$pageNumber - 1 ?>" class='btn btn-info' id="previous">Previous</a>
        <? endif ?>
        
        <!-- work on this line to display next page -->
        <? if($pageNumber <= 2): ?>
            <a href="?page=<?=$pageNumber + 1 ?>" class='btn btn-info' id="next">Next</a>
        <? endif ?>
        
        <form method="POST" action="/new_todo.php" class='form-horizontal' role='form'>
            <h2>Insert a New Item</h2>
            <input id="content" name="content" placeholder="Add New Item" autofocus>
           
            
            <button id="add" class="btn btn-info">Submit</button>  
        </form>
        
        
        
    </body>
</html>
