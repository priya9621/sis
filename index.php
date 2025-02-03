<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <style>
        /* Custom styles for the background image and overlay */
        .bg-image {
            background-image: url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }
        
        .display-2 {
            font-size: calc(1.5rem + 5vw); /* Responsive font size for main heading */
        }
    </style>
</head>


<body class="bg-image" style="background-image:url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg'); background-size: cover;">
<?php 
 require_once('./config.php');


?>
<nav class="navbar navbar-expand-md navbar-light bg-dark">
    <a href="./index.php" class="navbar-brand py-2 md-2"><i class="fas fa-school text-warning fa-2x"></i></a>
    
    <!-- Toggler Button -->
    <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav">
            <h3 class="text-light py-2 m-2">MicronInfotech - <span class="text-info">SchoolSolution</span></h3>
        </ul>  
        <div class="ml-auto d-flex">
            <button class="btn btn-outline-danger btn-sm mx-2" style="border-radius: 12px;">
                <a class="nav-link text-light text-uppercase font-weight-bold py-1" href="./Exportproject/admin-login.php">Admin</a>
            </button>                     
            <button class="btn btn-outline-info btn-sm mx-2" style="border-radius: 12px;">
                <a class="nav-link text-light text-uppercase font-weight-bold py-1" href="./Importproject/login.php">User</a>
            </button> 
            <button class="btn btn-outline-warning btn-sm mx-2" style="border-radius: 12px;">
                <a class="nav-link text-light text-uppercase font-weight-bold py-1" href="./Developer-team.php">Developer's</a>
            </button> 
        </div>
    </div>    
</nav>

<section>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" style="height: 75vh;">
            <div class="col-sm-10 text-center">
                <h1 class="display-2 text-capitalize font-italic font-weight-bold">
                    <span class="text-warning">Welcome To</span>
                    <span class="text-white">MicronInfotech School Solution</span>
                </h1>
                <!-- Add Admin and User Buttons -->
                <div class="mt-5">
                    <a href="<?php echo base_url; ?>./Exportproject/admin-login.php" class="btn btn-danger btn-lg mx-4 font-weight-bold">Admin</a>
                    <a href="<?php echo base_url; ?>./Importproject/login.php" class="btn btn-warning btn-lg mx-4 font-weight-bold text-black">User</a>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="text-center fixed-bottom bg-dark">
    <div>
        <p class="text-center m-2 text-light">&copy;Developed by Micron-Infotech <?=date('Y')?>.</p>
    </div>
</footer>

<!-- Bootstrap and jQuery Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBkN5ZBbI3/5hKfQ5iJvv6Az9I1RQp36d5I73xg5B" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>
