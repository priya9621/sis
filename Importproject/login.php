
<?php
// require './login-header.php';
require '../loginheader.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['uname'];
    $password = $_POST['password']; // This is the plain-text password from the form

    require "../connection.php";

    // Prepared statement to prevent SQL injection
    $stmt = $mysqli->prepare("SELECT password, school_name FROM register WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword, $school_name);
        $stmt->fetch();

        // Verify the password and school name
        if (password_verify($password, $hashedPassword) && $school_name == $school_name) {
            // Password and school name are correct
            $_SESSION["username"] = $username;
            $_SESSION["school_name"] = $school_name;
            $_SESSION["logged_in"] = true;

            // Redirect to dashboard
            header("Location: dashboard.php");
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
    <style>
        .bg-image {
            background-image: url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }
    </style>
</head>
<body class="bg-image d-flex align-items-center justify-content-center">
    <!-- Main Container -->
    <?php require_once '../config.php'?>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-info text-white">
                        <h5>Login Form</h5>
                    </div>
                    <div class="card-body bg-light">
                        <form action="" method="post">
                            <!-- Username -->
                            <div class="form-group">
                                <label for="username"><b>Username</b></label>
                                <input type="text" id="user" name="uname" placeholder="Enter your username" class="form-control" autofocus>
                                <span id="use" class="text-danger"></span>
                            </div>
                            <!-- Password -->
                            <div class="form-group">
                                <label for="password"><b>Password</b></label>
                                <input type="password" id="pass" name="password" placeholder="Enter your password" class="form-control">
                                <span id="pas" class="text-danger"></span>
                            </div>
                            <!-- Login Button -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block" name="login" id="btn">Login</button>
                            </div>
                            <!-- Register Link -->
                            <div class="form-group">
                                <a href="<?php echo base_url; ?>Importproject/register.php" class="btn btn-info btn-block">Register</a>
                            </div>
                        </form>
                        <!-- Back Button -->
                        <div class="text-center mt-3">
                            <a href="../index.php" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

    <br>
<br>
<footer class="text-center  fixed-bottom bg-dark">
    
  </footer>     
</body>
</html>