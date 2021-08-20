<?php
session_start();
require_once 'components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
//if session user exist it shouldn't access dashboard.php
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

$id = $_SESSION['adm'];
$status = 'adm';
$sql = "SELECT * FROM users WHERE status != '$status'";
$result = mysqli_query($connect, $sql);

$res = mysqli_query($connect, "SELECT * FROM users WHERE id=" . $_SESSION['adm']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
$admName = $row["first_name"];

//this variable will hold the body for the table
$tbody = ''; 
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td><img class='img-thumbnail rounded-circle' src='pictures/" . $row['picture'] . "' alt=" . $row['first_name'] . "></td>
            <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
            <td>" . $row['date_of_birth'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['telnumber'] . "</td>
            <td>" . $row['address'] . "</td>
            <td><a href='update.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
            <a href='delete.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
         </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adm-DashBoard</title>
    <?php require_once 'components/boot.php'?>
    <style type="text/css">        
        .img-thumbnail{
            width: 70px !important;
            height: 70px !important;
        }
        td
        {
            text-align: left;
            vertical-align: middle;
        }
      
        .userImage{
width: 100px;
height: auto;
}
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="row">
        <div class="col-2">
        <img class="userImage" src="pictures/admavatar.png" alt="Adm avatar">
        <strong> <p class="mt-2"> <?= $admName ?>  Administrator</p> </strong>
        <a style="width: 150px; margin-top:0.5em;" class="btn btn-success" href="animals/index.php">Manage Animals</a> <br>
        <a style="width: 150px; margin-top:0.5em;" class="btn btn-danger" href="logout.php?logout">Sign Out</a>
        </div>
        <div class="col-8 mt-2">
        <p class='h2'>Users</p>
        <table class='table table-striped'>
            <thead class='table-success'>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Date of birth</th>
                    <th>Email</th>
                    <th>Tel Number</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?=$tbody?>
            </tbody>
        </table>
        </div>
    </div>
</div>
</body>
</html>