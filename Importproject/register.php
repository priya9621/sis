<?php
include('../connection.php');

session_start();

if(isset($_POST['submit'])){
    $name=$_POST['nameu'];
    $email=$_POST['email'];
    $school_name=$_POST['sname'];
    $password=$_POST['pname'];
    $confirm_password=$_POST['cpname'];


     // Hash password
     $password_hash = password_hash($password, PASSWORD_DEFAULT);
     $confirm_password_hash = password_hash($confirm_password, PASSWORD_DEFAULT);



    $res=$mysqli->query("SELECT *FROM register WHERE username= '$name'");
    $res=$mysqli->query("SELECT *FROM register WHERE school_name= '$school_name'");


    if($res->num_rows>0){
        echo "<script>alert('Username already exists')</script>";
        echo "<script>alert('Email already exists')</script>";
        echo "<script>alert('Schoolname already exists')</script>";
    }else{

        $query="INSERT INTO register(username,email,school_name,password,confirm_password) 
        VALUES(?,?,?,?,?)";

        if(!($stmt=$mysqli->prepare($query))){
            echo "prepare Failed :(".$mysqli->errno.")".$mysqli->error;
          }
        
          if(!$stmt->bind_param("sssss",$name,$email,$school_name,$password_hash,$confirm_password_hash)){
              echo "Bonding parameter failed:(".$mysqli->errno.")".$mysqli->error;
          }
          if(!$stmt->execute()){
              echo "Execution failed :(".$mysqli->errno.")".$mysqli->error;
          }
      
          $lastInsertedID = mysqli_insert_id($mysqli);  
          $stmt->close();
          $mysqli->close();
         $_SESSION['username'] = $name;
         $_SESSION['school_name'] = $school_name;
         $_SESSION['logged_in'] = true;

        $_SESSION['user_id'] = $lastInsertedID;
         header('Location: dashboard.php');
         exit;

    }

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
            $("#btnn").click(function(){
               
        // Username -- Validation //
            
        if($("#user").val()==""){
            alert("Please enter your username...!");
            $("#use").val('');
            $("#user").focus();
            return false;
        }
        if($("#user").val().length<3){
            alert("User name must be 3 character...!");
            $("#user").val('');
            $("#user").focus();
            return false;
        }
        if($.isNumeric($("#user").val())){
            alert("Username is alphanumeric...!");
            $("#user").val('');
            $("#user").focus();
            return false;
        }
        
        // email validaation

        //empty vaidation

        if($("#email").val()==""){
          alert("Please Enter Your Email");
          $("#email").val('');
          $("#email").focus();
          return false;
        }
            
        // length validation

        if($("#email").val().length<=2){
          alert("Email must have atleast 3 char");
          $("email").val('');
          $("#email").focus();
          return false;
        }
           
           
        //@ validation 

        if($("#email").val().indexOf("@")== -1){
           alert("Email must have @ char ");
           $("email").val('');
           $("#email").focus();
           return false;
        }

        // . validation

        if($("#email").val().indexOf(".")== -1){
           alert("Email must have . dout ");
           $("email").val('');
           $("#email").focus();
           return false;
        }

        
        // School name -- Validation //
            
        if($("#sname").val()==""){
            alert("Please enter your School Name...!");
            $("#sname").val('');
            $("#sname").focus();
            return false;
        }
        if($("#sname").val().length<3){
            alert("School name must be 3 character...!");
            $("#sname").val('');
            $("#sname").focus();
            return false;
        }
        if($.isNumeric($("#sname").val())){
            alert("Schoolname is alphanumeric...!");
            $("#sname").val('');
            $("#sname").focus();
            return false;
        }

        // Paassword --- Validation //
        
        if($("#pass").val()==""){
            alert("please enter your password...!");
            $('#spass').val('');
            $("#pass").focus();
            return false;
        }
        if($("#pass").val().length<3){
            alert("Password must be 3 character...!");
            $("#pass").val('');
            $("#pass").focus();
            return false;
        }
        if($.isNumeric($("#pass").val())){
            alert("password is alphanumeric...!");
            $("#pass").val('');
            $("#pass").focus();
            return false;
        }
        // confirm -- passwpord validation  //
        if($("#cpass").val()==""){
            alert("Please enter your confirm password...!");
            $("#cpss").val('');
            $("#pass").focus();
            return false;
        }
        if(!($("#cpass").val()==$("#pass").val())){
            alert("Password and re-password doesn't match");
            $("#cpass").val('');
            $("#cpass").focus();
            return false;
        }

        })

      })
    </script>


</head>
<body class="bg-image "   style="background-size: 200vh; background-image:url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');">   

<nav class="navbar navbar-expand-md navbar-light bg-dark">
    <a href="/school-project/index.php" class="navbar-brand py-2 md-2"><i class="fas fa-school text-warning fa-2x"></i></a>
    
    <!-- Toggler Button -->
    <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav">
            <h3 class="text-light py-2 m-2">MicronInfotech - <span class="text-info">SchoolSolution</span></h3>
        </ul>  
        </div>
    </div>    
</nav>
<!-- end nav -->
  <div class="container">
  <div class="container col-12 col-md-7 col-lg-6  mt-5">
    <div class="card shadow ">    
        <div class="card-header bg-info text-center text-light">
        <h6>Register Form</h6>
    </div>
    <div class="card-body">        
        <form action="" method="post">
        <div class="form-group">
           <label for="username"><b>Username</b></label>
           <input type="username" id="user" name="nameu" autofocus placeholder="username..." class="form-control"> 
            <span id="use" class="text-primary"></span>
        </div>
        <div class="form-group">
           <label for="email"><b>Email</b></label>
           <input type="email" id="email" name="email" autofocus placeholder="email..." class="form-control"> 
            <span id="email" class="text-primary"></span>
        </div>
        <div class="form-group">
           <label for="schoolname"><b>School name</b></label>
           <input type="schoolname" id="sname" name="sname" autofocus placeholder="schoolname..." class="form-control"> 
            <span id="sname" class="text-primary"></span>
        </div>
        <div class="form-group">
            <label for="Password"><b>Password</b></label>
            <input type="Password" id="pass" name="pname"  placeholder="password..." class="form-control">
            <span id="spass" class="text-primary"></span>
        </div>
        
        <div class="form-group">
            <label for="confirm password"><b>Confirm Pass</b></label>
            <input type="Confirm password" id="cpass" name="cpname" placeholder="conf.. password" class="form-control">
            <span id="cpss" class="text-primary"></span>
        </div>
            <button class="btn btn-block bg-success text-light" name="submit" id="btnn">Register</button>
            
            <a href="./login.php" class="btn btn-block bg-info text-light">Login</a>
            
    </form>
     <!-- Back Button -->
        <div class="text-center mt-3">
             <a href="../index.php" class="btn btn-secondary">Back</a>
        </div>
    </div>
    </div>
  </div>
    <br>
<br>
<footer class="text-center  fixed-bottom bg-dark">
    <!-- Copyright -->
    <div>
       <p class="text-center m-2 text-info">&copy;copyright Develop_By: Micron-Infotech<?=date('Y')?>..</p>
    </div>
    <!-- Copyright -->
  </footer>  
  <!-- Bootstrap and jQuery Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBkN5ZBbI3/5hKfQ5iJvv6Az9I1RQp36d5I73xg5B" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
</div>
</body>
</html>