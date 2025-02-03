<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./style.css">   
    <title>Dashboard Page</title>
</head>
<body class="bg-image" style="background-size: 200vh; background-image: url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');">   

<?php require_once '../config.php'?>

   <nav class="navbar navbar-expand-md navbar-light bg-dark">
    <a href="<?php echo base_url; ?>/sis/index.php" class="navbar-brand py-2 md-2">
        <i class="fas fa-school text-warning fa-2x"></i>
    </a>
    <!-- Toggler Button -->
    <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
        <?php if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) { ?>                  
            <ul class="navbar-nav">
                <h3 class="text-light py-2 m-2">MicronInfotech - <span class="text-info">SchoolSolution</span></h3>
                <li class="nav-item p-2"><a class="nav-link text-light text-uppercase font-weight-bold py-3" href="staff.php">Staff</a></li>
                <li class="nav-item p-2"><a class="nav-link text-light text-uppercase font-weight-bold py-3" href="student.php">Student</a></li>  
            </ul>
            <!-- LogOut link for logged-in users only -->
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

    <section>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" style="height: 75vh;">
            <div class="text-center">
                <h1 class="display-4 font-italic font-weight-bold">Welcome <span class="text-light font-italic font-weight-bold"><?php echo $_SESSION["username"]; ?></span></h1>
                <h1 class="font-italic font-weight-bold display-4 text-mute"> School- <span class="text-warning"><?php echo $_SESSION["school_name"]; ?></span><a href="dashboard_edit.php" class="mx-3"><i class='fas fa-edit text-light' style="font-size: 40px;"></i></a></h1>
                

                <!-- Add Staff and Student Buttons -->
                <div class="mt-5">
                    <a href="./staff.php" class="btn btn-primary  mx-4 btn-lg " style="font-size: 18px;">Staff</a>
                    <a href="./student.php" class="btn btn-success mx-4 btn btn-lg" style="font-size: 18px;">Student</a>
                </div>
            </div>
        </div>
    </div>
</section>


    <br><br>
    <footer class="text-center text-lg-start fixed-bottom bg-dark">
        <div>
            <p class="text-center m-2 text-light">&copy; copyright Developed By: Micron-Infotech <?= date('Y') ?>..</p>
        </div>
    </footer>

    <!-- Bootstrap and jQuery Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBkZtA2mQc98oLPCQ/4fJK7f9FW5DXvjgM5Lcc0NQ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
