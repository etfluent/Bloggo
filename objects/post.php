<?php
class Post{

    // database connection and table name
    private $conn;
    private $table_name = "posts";

    // object properties
    public $postID;
    public $title;
    public $text;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read posts
    function read(){

        // select all and sort by postID descending
        $query = ('SELECT * FROM ' . $this->table_name .
                 ' ORDER BY "postID" DESC');

        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

};