<?php
    require_once 'components/db_connect.php';

    if($_GET["id"]) {
        $id = $_GET["id"];
        $sql= "SELECT * FROM animals WHERE id = {$id}";
        $result = mysqli_query($connect, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if(mysqli_num_rows($result) == 1) {
            $data = mysqli_fetch_assoc($result);
        } else {
            header("location: error.php");
        }
        mysqli_close($connect);
    } else {
        header("location: error.php");
    }

    $body="";

    foreach($rows as $row) {
        $body .= '<div class=" mb-5 col col-12 d-flex align-items-stretch">
        <div class="row g-1 container-fluid card shadow-lg bg-card-color">
        <img src=animals/pictures/'.$row["picture"].' class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">'.$row["name"].'</h5>
          <hr>
          <p class="card-text">Location : '.$row["location"].'</p>
          <p class="card-text">Description: '.$row["description"].'</p>
          <p class="card-text">Hobbies: '.$row["hobbies"].'</p>
          <p class="card-text">Breed: '.$row["breed"].'</p>
          <p class="card-text">Age: '.$row["age"].'</p>
          <p class="card-text">Type: '.$row["type"].'</p>
          <p class="card-text">Status: '.$row["status"].'</p>
          
          <a href="index.php" class="btn btn-success">Go Back</a>
        </div>
      </div>
      </div>
      ';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once 'components/boot.php' ?>
    <title>Details</title>
</head>
<body>
<?php require_once'components/navbar.php'; ?>
<div class="container text-center d-flex align-items-center justify-content-center">

<?=$body?>

</div>
<?php require_once'components/footer.php'; ?>
</body>
</html>