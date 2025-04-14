<?php
session_start();
include '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
;

if(isset($_GET['id'])) {
    $image = $conn->query("SELECT * FROM posts WHERE id = " . $_GET['id'])->fetch_assoc()['image'];
    if($image){
        $image_path = "../uploads/" . $image;
       if(file_exists($image_path)) {
            unlink($image_path);
       };
    
    };

    $conn->query("DELETE FROM posts WHERE id = " . $_GET['id']);
    header("Location: posts.php?success=Post Deleted successfully");
    exit();
}
?>