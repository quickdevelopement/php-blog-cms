<?php 
session_start();

include "../config.php";

if($_SERVER['REQUEST_METHOD'] == "POST" && $_FILES['avatar']['name']) {
   
    $existingImage = $conn->query("SELECT avatar FROM admins WHERE id = " . $_SESSION['admin_id'])->fetch_assoc();
    $image_path = "../uploads/" . $existingImage['avatar'];
    if(file_exists($image_path)) {
        unlink($image_path);
    };

    $image = $_FILES['avatar']['name'];
    $image_tmp = $_FILES['avatar']['tmp_name'];
    $imgName = "avatar-".time() ."-" . $image;
    $image_path = "../uploads/" . $imgName;

    if(move_uploaded_file($image_tmp, $image_path)) {
        $stmt = $conn->prepare("UPDATE admins SET avatar = ? WHERE id =? " );
        $stmt->bind_param("si", $imgName, $_SESSION['admin_id']);
        $stmt->execute();   

        header("Location: profile.php?success=Profile Picture Updated successfully");
        exit();

    }else{
        header("Location: profile.php?error=Profile Picture Upload Failed");
        exit();
    }
};

?>