<?php 
        if($_SERVER["REQUEST_METHOD"] == 'POST'){ // Check if the User coming from a request
                $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL); // simple validation if you insert an email
                $msg = filter_var($_POST["msg"], FILTER_SANITIZE_STRING); // simple validation if you insert a string

                // mail function in php look like this  (mail(To, subject, Message, Headers, Parameters))
                $headers = "FROM : ". $email . "\r\n";
                $myEmail = "k.patrick96@gmail.com";
                if(mail($myEmail, "message coming from the contact form", $msg, $headers)){
                        echo "sent";
                }else {
                        echo "error";
                }

        }
?>
<!DOCTYPE html>
<html>
<head>
        <title>Contact Us</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
        <form method="POST" class="container">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email">
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="msg"></textarea>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Send</button>
                  </div>
         </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>