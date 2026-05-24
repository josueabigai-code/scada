<?php
include("config/db.php");

$title=$_POST['title'];
$desc=$_POST['description'];

$image=$_FILES['image']['name'];
$video=$_FILES['video']['name'];

move_uploaded_file(
$_FILES['image']['tmp_name'],
"uploads/images/".$image
);

move_uploaded_file(
$_FILES['video']['tmp_name'],
"uploads/videos/".$video
);

$conn->query("
INSERT INTO reports(title,description,image,video)
VALUES('$title','$desc','$image','$video')
");

header("Location: dashboard.php");
?>