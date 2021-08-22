<?php

session_start();
    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: ../index.php");
        exit;
    }
    if(isset($_SESSION["user"])){
        header("Location: ../home.php");
        exit;
    }

    require_once "../components/db_connect.php";

    $sql = "SELECT * from animals";
    $result = mysqli_query($connect, $sql);
    $rows= mysqli_fetch_all($result, MYSQLI_ASSOC);
  
  
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once '../components/boot.php'?>
        <title>PHP CRUD  |  Add Animal</title>
        <style>
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 60% ;
            }       
        </style>
    </head>
    <body>
        <fieldset>
            <legend class='h2'>Add Animal</legend>
            <form action="actions/a_create.php" method= "post" enctype="multipart/form-data">
                <table class='table'>
                    <tr>
                        <th>Name</th>
                        <td><input class='form-control' type="text" name="name"  placeholder="Animal Name" /></td>
                    </tr>  
                    <tr>
                        <th>Location</th>
                        <td><input class='form-control' type="text" name="location"  placeholder="Location" /></td>
                    </tr>  
                    <tr>
                        <th>Description</th>
                        <td><input class='form-control' type="text" name= "description" placeholder="Description" /></td>
                    </tr>
                    <tr>
                        <th>Hobbies</th>
                        <td><input class='form-control' type="text" name="hobbies"  placeholder="Hobbies" /></td>
                    </tr> 
                    <tr>
                        <th>Breed</th>
                        <td><input class='form-control' type="text" name="breed"  placeholder="Breed" /></td>
                    </tr> 
                    <tr>
                        <th>Age</th>
                        <td><input class='form-control' type="number" name="age"  placeholder="Age" /></td>
                    </tr> 
                    <tr>
                        <th>Picture</th>
                        <td><input class='form-control' type="file" name="picture" /></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><select name="status" selected>
                            <option selected value="none">Please select one</option>
                                <option value="available">available</option>
                                <option value="adopted">adopted</option>
                        </select></td>
                    </tr>
                    <th>Type</th>
                        <td><select name="type" selected>
                        <option selected value="none">Please select one</option>
                                <option value="small">small</option>
                                <option value="large">large</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td><button class='btn btn-success' type="submit">Insert Animal</button></td>
                        <td><a href="index.php"><button class='btn btn-warning' type="button">Home</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>
    </body>
</html>