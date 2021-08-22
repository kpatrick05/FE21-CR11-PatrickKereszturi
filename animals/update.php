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
require_once '../components/db_connect.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animals WHERE id = {$id}";
    
    $result = mysqli_query($connect, $sql);
    

    $status ="";
    $type="";
    

    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $name = $data['name'];
        $location = $data['location'];
        $description = $data['description'];
        $hobbies = $data['hobbies'];
        $breed = $data['breed'];
        $age = $data['age'];
        $picture = $data['picture'];
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        
            if($data["status"]) {
         
                $status .= "<option selected value='".$data["status"]."'>".$data["status"]."</option>";
            }

            if($data["type"]) {
         
                $type .= "<option selected value='".$data["type"]."'>".$data["type"]."</option>";
            }
        
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Animal</title>
        <?php require_once '../components/boot.php'?>
        <style type= "text/css">
            fieldset {
                margin: auto;
                margin-top: 100px;
                width: 60% ;
            }  
            .img-thumbnail{
                width: 70px !important;
                height: 70px !important;
            }     
        </style>
    </head>
    <body>
        
        <fieldset>
            <legend class='h2'>Update request <img class='img-thumbnail rounded-circle' src='pictures/<?php echo $picture ?>' alt="<?php echo $name ?>"></legend>
            <form action="actions/a_update.php"  method="post" enctype="multipart/form-data">
                <table class="table">
                <tr>
                        <th>Name</th>
                        <td><input class='form-control' type="text" name="name"  placeholder="Animal Name" value="<?=$name ?>"></td>
                    </tr>  
                    <tr>
                        <th>Location</th>
                        <td><input class='form-control' type="text" name="location" placeholder="Location" value="<?=$location?>"></td>
                    </tr> 
                    <tr>
                        <th>Description</th>
                        <td><input class='form-control' type="text" name="description" placeholder="Description" value="<?=$description ?>"></td>
                    </tr>
                    <tr>
                        <th>Hobbies</th>
                        <td><input class='form-control' type="text" name="hobbies"  placeholder="Hobbies" 
                        value="<?=$hobbies ?>"/></td>
                    </tr> 
                    <tr>
                        <th>Breed</th>
                        <td><input class='form-control' type="text" name="breed"  placeholder="Breed" 
                        value="<?=$breed ?>"></td>
                    </tr> 
                    <tr>
                        <th>Age</th>
                        <td><input class='form-control' type="number" name="age"  placeholder="Age" 
                        value="<?=$age ?>"></td>
                    </tr> 
                    <tr>
                        <th>Picture</th>
                        <td><input class='form-control' type="file" name="picture" 
                        value="<?=$picture ?>"></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><select name="status">
                            <?= $status ?>
                            <?php if($data["status"] == "available"){
                                echo "<option value='adopted'>adopted</option>";
                            } else {
                                echo  "<option value='available'>availalbe</option>";
                            }
                             ?>
                        </select></td>
                    </tr>
                    <th>Type</th>
                        <td><select name="type">
                        <?= $type ?>
                            <?php if($data["type"] == "small"){
                                echo  "<option value='big'>big</option>";
                            } else {
                                echo  "<option value='small'>small</option>";
                            }
                            ?>
                        </select></td>
                    </tr>
                    <tr>
                        <input type= "hidden" name= "id" value= "<?php echo $data['id'] ?>" >
                        
                        <input type= "hidden" name= "picture" value= "<?php echo $data['picture'] ?>" >
                        <td><button class="btn btn-success" type= "submit">Save Changes</button></td>
                        <td><a href= "index.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                    </tr>
                </table>
            </form>
        </fieldset>
        
    </body>
</html>