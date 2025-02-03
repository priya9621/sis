<?php
// require './login-header.php';
require '../loginheader.php';
session_start();


if (isset($_POST['login'])) {
    $username = $_POST['uname'];
    $password = $_POST['password']; // This is the plain-text password from the form

    require "../connection.php";

    // Prepared statement to prevent SQL injection
    $stmt = $mysqli->prepare("SELECT password FROM admin_login WHERE username = ?");
    $stmt->bind_param("s", $username);
    // echo $stmt;die;
    $stmt->execute();
    $result = $stmt->get_result();
    // $result = $stmt->store_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $password1 = $row['password'];
        // echo "Password1: " . $password1;
        // $stmt->bind_result($password);
        // $stmt->fetch();

        // Verify the password and school name
        if ( $password == $password1) {
            // Password and school name are correct
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            $_SESSION["logged_in"] = true;

            // Redirect to dashboard
            header("Location: index.php");
            exit();
            
        } else {
            // Invalid password or school name
            echo "<script>alert('Invalid username or password')</script>";
        }
    } else {
        // No user found with that username
        echo "<script>alert('Invalid username or password')</script>";
    }

    $stmt->close();
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <title>Document</title>
    <script src="./js-jquery.js"></script>
    <script>
    $(document).ready(function(){
        $("#btn").click(function(){
        
            // Clear previous error messages
            $("#use").html("");
            $("#pas").html("");
            
            // Username validation
            if($("#user").val() == ""){
                $("#use").html("<span style='color:red;'>*Please enter your username.</span>");
                $("#user").focus();
                return false;
            } 
            if($("#user").val().length < 3){
                $("#use").html("<span style='color:red;'>Username must be at least 3 characters.</span>");
                $("#user").val('');
                $("#user").focus();
                return false;
            } 
            if($.isNumeric($("#user").val())){
                $("#use").html("<span style='color:red;'>Username should not be numeric.</span>");
                $("#user").val('');
                $("#user").focus();
                return false;
            }

            // Password validation
            if($("#pass").val() == ""){
                $("#pas").html("<span style='color:red;'>*Please enter your password.</span>");
                $("#pass").focus();
                return false;
            }

            if($("#pass").val().length < 3){
                $("#pas").html("<span style='color:red;'>Password must be at least 3 characters.</span>");
                $("#pass").val('');
                $("#pass").focus();
                return false;
            }
            if($.isNumeric($("#pass").val())){
                $("#pas").html("<span style='color:red;'>Password should not be numeric.</span>");
                $("#pass").val('');
                $("#pass").focus();
                return false;
            }
        });
    });
</script>
</head>

<body class="bg-image "   style="background-size: 200vh; background-image:url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');">  
     
   <div class="container">
      <div class="container col-12 col-md-7 col-lg-6  mt-5">
        <div class="card my-5 shadow">
            <div class="card-header text-center bg-info text-light">
               <h6> Admin Login</h6>
            </div>
            <div class="card-body bg-light">
            <form action="" method="post"> 
            <div class="form-group">          
               <label for="username"><b>Username</b></label>
               <input type="username" id="user" name="uname" autofocus placeholder="username..." class="form-control">
               <span id="use" class="text-primary"></span>
            </div>

            <div class="form-group">
                   <label for="Password"><b>Password</b></label>
                   <input type="Password" id="pass" name="password" placeholder="password..." class="form-control">
                   <span id="pas" class="text-primary"></span>
                </div>
               <div class="form-group" >
                   <button class="btn btn-block bg-success text-light" name="login" id="btn">Login</button>
               </div>
            
            </form>
            <div class="mt-3">
                <!-- Back buttan -->
                 <a href="../index.php" class="btn btn-black btn-secondary">Back</a>
            </div>
            </div>
        </div>
      </div>
   </div>
    <br>
<br>
<footer class="text-center  fixed-bottom bg-dark">
    
  </footer>     
</body>
</html>