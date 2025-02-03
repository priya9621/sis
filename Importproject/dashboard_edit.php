<?php
     session_start();
    // require_once '../header.php';
    include('../connection.php');
    // die; 

     if(!isset($_SESSION['logged_in'])){
        header('location: login.php');
        exit;
     }
    
    if(isset($_POST['update_btn']))
    {
        $id=  $_SESSION['user_id'];
   
        $school_name= $_POST['sname'];

    $query = "UPDATE register SET school_name='$school_name' WHERE id='$id'";
    $update = mysqli_query($mysqli,$query);

    $_SESSION['school_name']=$school_name;
    $_SESSION['logged_in'] = true;
     header('location: dashboard.php');
     exit;
     
     } 
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
            <script src="./js-jquery.js"></script>
    
    <script>
        $(document).ready(function(){
            $("#btn").click(function(){
      
        // School name -- Validation //
            
        if($("#school").val()==""){
            alert("Please enter your School Name...!");
            $("#school").val('');
            $("#school").focus();
            return false;
        }
        if($("#school").val().length<3){
            alert("School name must be 3 character...!");
            $("#school").val('');
            $("#school").focus();
            return false;
        }
        if($.isNumeric($("#school").val())){
            alert("Schoolname is alphanumeric...!");
            $("#school").val('');
            $("#school").focus();
            return false;
        }
        })

      })
    </script>
        </head>

        <body class="bg-image" style="background-size: 200vh; background-image:url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');">   

            <div class="container" style="margin-top: 100px;">
                <div class="panel panel-danger">
                    <div class="panel-heading ">
                        <h4 class="text-info text-center text-uppercase text-justify">Update School Name</h4>
                    </div>


                    <form action="" class="form-horizontal container" method="post" >
                        <div class="panel-body" >
        
                            <div class="form-group">
                                <label class="control-label col-sm-5">School Name:</label>
                                <div class="form-group col-sm-3">
                                    <input class="form-control" value="<?php echo $_SESSION['school_name']?>" type="text" name="sname" id="school" required>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label class="control-label col-sm-5"></label>
                                <div class="form-group col-sm-3">
                                    <a href="./dashboard.php" class="btn btn-danger mx-3" style="border-radius: 10px;">Cancel</a>
                                    <input type="submit" class="btn btn-warning" style="border-radius: 10px;" name="update_btn" id="btn" value="Update">
                                </div>
                            </div>
                        </div>
                    </form>
            
                </div>
            </div>
            </div>
        </body>

        </html>