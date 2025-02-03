<?php
 session_start();
 if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location:admin-login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MicronInfotech School Solution</title>
  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
  
  <!-- Custom Styles -->
  <style>
    .bg-image {
      background-size: cover;
      background-position: center;
      height: 100vh;
    }
    .navbar-brand {
      font-size: 1.5rem;
    }
    .navbar-nav {
      flex: 1;
      /* justify-content: center;  */
    }
    .text-container {
      position: relative;
      z-index: 1;
    }
    .display-2 {
      font-size: calc(2rem + 3vw); Responsive font size
    }
    .bg-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;

    }
  </style>
</head>
<body class="bg-image" style="background-image: url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');">


<?php 
 require_once('../config.php');

?>

  <!-- Overlay for text visibility -->
  <div class="bg-overlay"></div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-light bg-dark fixed-top">
    <a href="/sis/index.php" class="navbar-brand py-2">
      <i class="fas fa-school text-warning fa-2x"></i>
    </a>
    <button type="button" class="navbar-toggler bg-light" data-toggle="collapse" data-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
    <?php if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) { ?>                  

      <ul class="navbar-nav mx-auto">
        <h3 class="text-light py-2 m-2">MicronInfotech - <span class="text-info">SchoolSolution</span></h3>
        <li class="nav-item p-2">
          <a class="nav-link text-light text-uppercase font-weight-bold py-3" href="./staff-select-school.php">Staff</a>
        </li>
        <li class="nav-item p-2">
          <a class="nav-link text-light text-uppercase font-weight-bold py-3" href="./std-select-sch.php">Student</a>
        </li> 
        </ul>  
 
        <div class="ml-auto d-flex float-right p-2">
                <a class="nav-link text-light text-uppercase font-weight-bold py-3" href="./logout.php">LogOut</a>                 
            </div>                   
      <?php } else { ?>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link text-light text-uppercase font-weight-bold py-3" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link text-light text-uppercase font-weight-bold py-3" href="register.php">Register</a></li>
            </ul>
        <?php } ?>  
    </div>
  </nav>

  <section class="d-flex justify-content-center align-items-center text-container" style="height: 75vh;">
    <div class="container text-center">
      <h1 class="display-2 text-capitalize font-italic font-weight-bold">
        <span class="text-warning">Welcome To</span>
        <span class="text-white">MicronInfotech School Solution</span>
      </h1>
      <div class="mt-5">
      
        <a href="<?php echo base_url; ?>Exportproject/staff-select-school.php" class="btn btn-warning btn-lg mt-4 mx-5">Staff</a>
        <a href="<?php echo base_url; ?>Exportproject/std-select-sch.php" class="btn btn-info btn-lg mt-4 mx-5">Student</a>
      </div>
    </div>
  </section>


  <!-- Footer -->
  <footer class="text-center bg-dark fixed-bottom">
    <p class="text-center m-2 text-light">&copy; Developed by Micron-Infotech, <script>document.write(new Date().getFullYear())</script>.</p>
  </footer>

  <!-- Bootstrap JS, Popper.js, and jQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBkZtA2mQc98oLPCQ/4fJK7f9FW5DXvjgM5Lcc0NQ" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>
