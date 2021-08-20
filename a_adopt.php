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



if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals  WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);

        $animal_id = $data['id'];
        $location = $data['location'];
       
        
        $name= $data['name'];
        $description = $data['description'];
        $hobbies = $data['hobbies'];
        $age = $data['age'];
        $picture = $data['picture'];
        $status = $data['status'];
        $type = $data['type'];

    } else {
        header("location: error.php");
    }
} else {
    header("location: error.php");
}


$user_id = $_SESSION['user'];
$query = "INSERT INTO petadoption (fk_animal_id, fk_user_id, adoption_date) VALUES ('$animal_id','$user_id', CURDATE())";
    if (mysqli_query($connect, $query) === true) {
        $query2 = "UPDATE `animals` SET `status` = 'adopted' WHERE `animals`.`id` = '$animal_id'";
        if (mysqli_query($connect, $query2) === true){
            $class = "success";
            $message = "<h2>Congratulations! You adopted: </h2><br>";
            $body =$name . "<img style='width:100%; height:500px; object-fit: cover;' src='animals/pictures/$picture'>" ."Location: " . $location . "<br>".$name ." will be a cute pet"  ;
        }
        else {
            $class = "danger";
            $tags = '';
            $message = "The pet was not adopted due to: <br>" . $connect->error;
        }
    } else {
        $class = "danger";
        $tags = '';
        $message = "The pet was not adopted due to: <br>" . $connect->error;
    }

$connect->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS bundle  -->
    <?php require_once 'components/boot.php' ?>
    <title>Update</title>
</head>
<body>
    <div class="container text-center">
        <div class="row justify-content-evenly py-5">
            <div class="d-flex flex-column align-items-center mt-3 mb-3">
                <h1>Adoption:</h1>
            </div>
            <div class="alert alert-<?=$class;?> d-flex flex-column align-items-center" role="alert">
                <?=$message;?>
                <h2><?=$body;?></h2>
                <a href='home.php' class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</body>
</html>