<?php
session_start();
require_once 'components/db_connect.php';

// if adm will redirect to dashboard
if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}



$sql ="SELECT * FROM animals";

    $result = mysqli_query($connect, $sql);

    
    $body = "";
    $nOR = mysqli_num_rows($result);

    if($nOR == 0) {
        $body = "No results";
    } else {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        foreach($rows as $val) {
            if($val["age"] > 8) {
            $body .= '<div class=" mb-5 col col-12 col-sm-12 col-md-6 col-lg-3 d-flex align-items-stretch">
            <div class="row g-1 container-fluid card shadow-lg bg-card-color">
            <div class="";">
            <img style="width:100%; height:220px; object-fit: cover;" src=animals/pictures/'.$val["picture"].' class="card-img-top img-fluid" alt="...">
            <div class="card-body">
              <h5 class="card-title">'.$val["name"].'</h5>
              <hr>
              <p class="card-text">Description:'.$val["description"].'<br> '.$val["location"].'</p>
              <p class="card-text">Age:'.$val["age"].'</p>
              <a href="show.php?id='.$val["id"].'" class="m-1 btn btn-warning">Show More Details</a>
              <a href="adopt.php?id='.$val["id"].'" class="m-1 btn btn-primary">Take Me Home</a>
            </div>
            </div>
            </div>
          </div>
          ';
        }
    }
    
}
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome - <?php echo $row['first_name']; ?></title>
<?php require_once 'components/boot.php'?>
<style>

</style>
</head>
<body>
<?php require_once 'components/navbar.php' ?>
<div class="container">
    <h2 class="text-center m-5">Our Senior Pets whos wants to be adopted</h2>
    <div class="row">
    <?= $body ?>
    </div>

    <a class="btn btn-success mb-4" href="home.php">Go back</a>
</div>
<?php require_once 'components/footer.php' ?>
</body>
</html>