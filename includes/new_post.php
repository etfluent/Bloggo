<?php
// create post
include('../config/database.php');
include('../objects/post.php');
    
// instantiate database and post object
$db = new Database();
// initialize object
$post = new Post($db);
// POST variables from form 
$title = $_POST['title'];
$text = $_POST['text'];
// initialize PDO
$pdo = $db->getConnection();
// echo fetch($pdo);
// prepare SQL statement to prevent SQL injection
$stmt = $pdo->prepare("INSERT INTO " . $post->table_name . " (title, text) VALUES ('$title', '$text')");
// execute SQL statement
if (!$stmt->execute(array('title' => $title, 'text' => $text))) {
    echo "not inserted";
} else {
    echo "data inserted";
}

header( "refresh:4;url=.." );
?>