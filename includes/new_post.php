<?php
// create post
include('../config/database.php');
include('../objects/post.php');
    
// instantiate database and post object
$db = new Database();
// $con = mysqli_connect($db->host, $db->username, $db->password, $db->db_name);
$con = mysqli_connect("localhost", "root", "", "Bloggo_db");
// initialize object
$post = new Post($db);
// POST variables from form 
$title = $_POST['title'];
$text = $_POST['text'];

$sql = "INSERT INTO " . $post->table_name . " (title, text) VALUES ('$title', '$text')";
if(!mysqli_query($con,$sql)) {
    echo 'Data not inserted';
} else {
    echo 'Data inserted';
}     
      
?>