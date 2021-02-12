<?php
session_start();
include('include/database.php');
include('include/function.php');
?>

<?php 

  if(isset($_POST['login']))
  {

    $username=$_POST['username'];
    $password=$_POST['password'];

    $checkuser=mysqli_query($conn,"SELECT * FROM authuser where username='".$username."' and password='".$password."' ");

    if($row=mysqli_num_rows($checkuser)>0){

    $res=mysqli_fetch_assoc($checkuser);



    $_SESSION['username']=$res['username'];
    $_SESSION['success']='yes';


    $success="<p style='color:green;'>Login succesfully</p>";
            header("Location:welcome.php");
        }else{
            $_SESSION['success']='no';
            $success="<p style='color:red;'>Check username/password</p>";
        }
     
  }


  if(isset($_POST['submit']))
  {
    $user=$_POST['user'];
    $pass=$_POST['pass'];
    $date=date('Y-m-d');
if(!empty($user)||!empty($pass)){



    $check=mysqli_query($conn,"SELECT * FROM authuser where username='".$user."'   ");

    if($res=mysqli_num_rows($check)>0)
    {
                         
            $success="<p style='color:green;'>User Already Register! please Try Different username/password</p>";
         
        }
        else
        {
        
          $query=mysqli_query($conn,"INSERT INTO authuser SET username='".$user."',password='".$pass."',created_date='".$date."'  ");

          if($query)
          {
             
            $success="<p style='color:green;'>User Register succesfully</p>";
          }
          else
          {
              echo "<script>window.alert('Something Went Wrong');</script>";
          }
        }
      }
      else
      {
         $success="<p style='color:red;'>Some Fields Are Empty</p>";
      }
  }


 ?>

<!DOCTYPE html>
<html lang="en">
<?php include('include/header.php');



 ?>
<body>
    <!-- Page Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>
   <?Php include('include/navbar.php'); ?>

  <div>
    <br>
     <div class="error" style="margin-left:645px;font-size: x-large;">
                        <?php echo isset($success)?$success:''; ?>
                </div>
          <form method="POST" action="">
              <div class="row">
    <div class="col-md-6 mx-auto p-0">
        <div class="card">
            <div class="login-box">
                <div class="login-snip"> <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label> <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
                    <div class="login-space">
                        <div class="login">
                            <div class="group"> <label for="user" class="label">Username</label> <input id="user" type="text" name="username"class="input" placeholder="Enter your username" > </div>
                            <div class="group"> <label for="pass" class="label">Password</label> <input id="pass" type="password" name="password" class="input" data-type="password" placeholder="Enter your password" > </div>
                            <div class="group"> <input id="check" type="checkbox" class="check" checked> <label for="check"><span class="icon"></span> Keep me Signed in</label> </div>
                            <div class="group"> <input type="submit" name="login"class="button" value="Sign In"> </div>
                            <div class="hr"></div>
                       
                        </div>

                        <!-- signup section -->
                        <div class="sign-up-form">
                            <div class="group"> <label for="user" class="label">Username</label> <input id="user" type="text" name="user" class="input" placeholder="Create your Username"> </div>
                            <div class="group"> <label for="pass" class="label">Password</label> <input id="pass" type="password" name="pass" class="input" data-type="password" placeholder="Create your password"> </div>
                            
                            <div class="group"> <input type="submit" class="button" name="submit" value="Sign Up"> </div>
                            <div class="hr"></div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        </form>
    </div><br><br>
     <!-- container-fluid, tm-container-content -->
<?php include('include/footer.php'); ?>
  
    
    <script src="js/plugins.js"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>
</body>
</html>