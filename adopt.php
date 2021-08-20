<?php

session_start();

include_once 'components/db_connect.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// if session is set to user this will redirect to the home page
if (isset($_SESSION['adm'])) {
    header("Location: adopted.php");
    exit;
}

$body = "";

if ($_GET['id']) {
    $id = $_GET['id'];
    $query = "SELECT * FROM animals  WHERE id = {$id}";
    $result = mysqli_query($connect, $query);
    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();

        $id = $data['id'];
        $location = $data['location'];
        $name= $data['name'];
        $description = $data['description'];
        $breed = $data["breed"];
        $hobbies = $data['hobbies'];
        $age = $data['age'];
        $picture = $data['picture'];
        $status = $data['status'];
        $type = $data['type'];

        
            $body .= '<div class=" mb-5 col col-12 d-flex align-items-stretch">
        <div class="row g-1 container-fluid card shadow-lg bg-card-color">
        <img style="width:100%; height:400px; object-fit: cover;" src=animals/pictures/'.$picture.' class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">'.$name.'</h5>
          <hr>
          <p class="card-text">Location : '.$location.'</p>
          <p class="card-text">Description: '.$description.'</p>
          <p class="card-text">Hobbies: '.$hobbies.'</p>
          <p class="card-text">Breed: '.$breed.'</p>
          <p class="card-text">Age: '.$age.'</p>
          <h3 class="mb-4">Do you really want to adopt this pet?</h3>
                <a href="a_adopt.php?id='.$id.'" class="btn btn-primary">Yes</a>
                <a href="javascript:history.back()" class="btn btn-danger">No</a><br>
          
          <a href="index.php" class="btn btn-success mt-2">Go Back</a>
        </div>
      </div>
      </div>
      ';
        

    } else {
        header("location: error.php");
    }
} else {
    header("location: error.php");
}

 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS bundle  -->
    <?php include_once 'components/boot.php';?>
    <title>Adopt Pet</title>
</head>
<body>
    <div class="container text-center">
        <div class="row justify-content-evenly py-5">
            <div class="mt-3 mb-3">
                <h1>Pet to be adopted</h1>
                <?= $body ?>
                
            </div>
        </div>
    </div>
    <?php
        include_once 'components/footer.php';
    ?>
</body>
</html>