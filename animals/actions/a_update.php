<?php
session_start();
if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
    header("Location: ../../index.php");
    exit;
}
if(isset($_SESSION["user"])){
    header("Location: ../../home.php");
    exit;
}
require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';

if ($_POST) {
    $id = $_POST["id"];  
    $location = $_POST['location'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $hobbies = $_POST['hobbies'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];

    $status = $_POST['status'];
    $type = $_POST['type'];
    //variable for upload pictures errors is initialized
    $uploadError = '';

    $picture = file_upload($_FILES['picture'], 'animals');//file_upload() called  
    if($picture->error===0){
        ($_POST["picture"]=="animal.jpg")?: unlink("../pictures/$_POST[picture]");           
        $sql = "UPDATE `animals` SET `location`='$location',`name`='$name',`description`='$description',`hobbies`='$hobbies',`breed`='$breed',`age`='$age',`picture`='$picture->fileName',`status`='$status',`type`='$type' WHERE id = {$id}";
    }else{
        $sql = "UPDATE `animals` SET `location`='$location',`name`='$name',`description`='$description',`hobbies`='$hobbies',`breed`='$breed',`age`='$age',`status`='$status',`type`='$type' WHERE id = {$id}";
    }    
    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error();
        $uploadError = ($picture->error !=0)? $picture->ErrorMessage :'';
    }
    mysqli_close($connect);    
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Update</title>
        <?php require_once '../../components/boot.php'?> 
    </head>
    <body>
        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Update request response</h1>
            </div>
            <div class="alert alert-<?php echo $class;?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='../update.php?id=<?=$id;?>'><button class="btn btn-warning" type='button'>Back</button></a>
                <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
            </div>
        </div>
    </body>
</html>