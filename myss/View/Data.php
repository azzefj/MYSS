<?php
class Post {
    public $titlePost = "";
    public $descriptionPost = "";
    public $username = "";
    public $postTime = "";
    public $tag = "";
    public function __construct($titlePost, $descriptionPost, $username, $postTime, $tag) {
        $this->titlePost = $titlePost;
        $this->descriptionPost = $descriptionPost;
        $this->username = $username;
        $this->postTime = $postTime;
        $this->tag = $tag;
    }
}
$start = $_GET['start'];
$data = array();
$possiblePost = array(
    new Post("Título #1","Descripción de prueba", "axl1210", "12:10", "YOLO"),
    new Post("Título#2","Descripción de prueba", "juancho", "12:10", "YOLO"),
    new Post("Título #3","Descripción de prueba", "mapachurro", "12:10", "YOLO"),
    new Post("Título #4","Descripción de prueba", "aobm", "12:10", "YOLO"),
    new Post("Título #5","Descripción de prueba", "azzefj", "12:10", "YOLO"),
    new Post("Título #6","Descripción de prueba", "axl1210", "12:10", "YOLO"),
    new Post("Título #7","Descripción de prueba", "axl1210", "12:10", "YOLO"),
    new Post("Título #8","Descripción de prueba", "axl1210", "12:10", "YOLO"),
    new Post("Título #9","Descripción de prueba", "axl1210", "12:10", "YOLO"),
    new Post("Título #10","Descripción de prueba", "axl1210", "12:10", "YOLO"),
    new Post("Título #11","Descripción de prueba", "axl1210", "12:10", "YOLO"),
    new Post("Título #12","Descripción de prueba", "axl1210", "12:10", "YOLO"),
    new Post("Título #13","Descripción de prueba", "axl1210", "12:10", "YOLO"),
    new Post("Título #14","Descripción de prueba", "axl1210", "12:10", "YOLO"),
    new Post("Título #15","Descripción de prueba", "axl1210", "12:10", "YOLO")
);
for ($i = $start; $i < $start+4; $i++) {
    if ($i < count($possiblePost)) {
        array_push($data, $possiblePost[$i]);
    }
}
//echo "<pre>";
echo json_encode($data);