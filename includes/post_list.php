<!-- Post List -->
<?php
// required headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include("./config/database.php");
include("./objects/post.php");
 
// instantiate database and post object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$post = new Post($db);
 
// query posts
$stmt = $post->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if ($num>0){
 
    // posts array
    $posts_arr=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['title'] to
        // just $title only
        extract($row);
 
        $post_item=array(
            "postID" => $postID,
            "title" => $title,
            "text" => $text,
        );
 
        array_push($posts_arr, $post_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show posts data in json format
    // echo json_encode($posts_arr);

    // display HTML
    include('./includes/newpost_card.php');
    echo '<div id="post_list">';
    foreach ($posts_arr as $p){
        echo '<div class="post"><h6>Title:</h6><h3>' . $p["title"] . '</h3><h6>Text:</h6><p>' . $p["text"] . '<br><br></div>';
    }
    echo '</div>';
    include('./includes/newpost_button.php');
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no posts found
    echo json_encode(
        array("message" => "No posts found.")
    );
}
?>
