<?php 
session_start();
include('include/function.php');
include('include/database.php');
checklogin();
$user=$_SESSION['username'];

 ?>

 <?php

 if(isset($_POST['submit'])){


    $select=$_POST['select'];
    $detail=$_POST['detail'];
    $cdate=date('Y-m-d H:i:s');

    $post=$_FILES['mypostfile']['name'];
    $temp=$_FILES['mypostfile']['tmp_name'];



    $dir="mypost/$post";

 $ppost=mysqli_query($conn,"INSERT INTO post  SET
                                                        filename='".$post."',
                                                         description='".$detail."',
                                                         filecat='".$select."',                                                         
                                                         user='".$_SESSION['username']."',
                                                         posteddate='".$cdate."'
                          ");
     

      if($ppost){
 move_uploaded_file($temp, $dir);
        $success="<p style='color:green;'>Post Added Successfully</p>";
      }

  }
if(!empty($_REQUEST['edit'])){

      $edit=mysqli_query($conn,"SELECT * from post where id='".$_REQUEST['edit']."'");    
      $redit=mysqli_fetch_assoc($edit); 

  }
if(isset($_POST['update'])){


    $cdate=date('Y-m-d H:i:s');
    if(!empty($_FILES['mypostfile']['name'])){
    $mypost=$_FILES['mypostfile']['name'];
    }else{
    $mypost=$_POST['myoldfile'];
    }
    $tmypost=$_FILES['mypostfile']['tmp_name'];
    $comment=$_POST['detail'];
    $category=$_POST['select'];
    $dir="mypost/$mypost";

      $ppost=mysqli_query($conn,"UPDATE post
                                                      SET
                                                         filename='".$mypost."',
                                                         description='".$comment."',
                                                         filecat='".$category."',                                                         
                                                         user='".$_SESSION['username']."',
                                                         posteddate='".$cdate."'

                                                         where id='".$_REQUEST['edit']."'
                          ");
      move_uploaded_file($tmypost, $dir);

      if($ppost){
        $success="<p style='color:green;'>Post Updated Successfully</p>";

      }



  }

 ?>
<!DOCTYPE html>
<html lang="en">
<?php include('include/header.php'); ?>
<body>
    <!-- Page Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>
   <?Php include('include/navbar.php'); ?>

       <!-- Bootstrap CDN -->
   <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style type="text/css">
        .nav-link-2{
        font-size: x-large!important;
                }

                .nav-link-4{
        font-size: x-large!important;
                }

    </style>
  
            <hr>
<a href="welcome.php"><button class="btn btn-primary  mb-2">Back</button></a>

<div class="error" style="margin-left:645px;font-size: x-large;">
                        <?php echo isset($success)?$success:''; ?>
                </div>
       <div class="container-fluid bg-light py-3">
    <div class="row">
        <div class="col-md-6 mx-auto">
                <div class="card card-body">
                    <h3 class="text-center mb-4">Make My Post</h3>
                    <div class="alert">
                      
                    </div>
                     <form method="POST" action="" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                                <label>Select Categories:</label>
                             <select class="form-control input-lg" id="select" name="select">
                              <option selected>Open this select menu</option>

                              <?php 
                              $query=mysqli_query($conn,"SELECT distinct id,type FROM category");

                              while($res=mysqli_fetch_assoc($query)){



                              echo "<option value='".$res['id']."'";
                              if(!empty($_REQUEST['edit'])){
                      
                              echo ($res['id']==$redit['filecat'])?" selected ":"";
                        }
                              echo ">".$res['type']."</option>";
                              }
                               ?>
                             
                        </select>
                            
                        </div>
                        <div class="form-group has-success">
                            <label>Enter Description Here:</label>
                            <textarea class="form-control input-lg" name="detail" ><?php if(!empty($_REQUEST['edit'])){echo $redit['description'];}else {} ?>  </textarea>
                        </div>
                       
                        <div class="form-group">
                            <label>Select File:</label>
                         <input class="form-control form-control-lg" id="mypostfile" name="mypostfile" accept="image/*" type="file" > 

                       <input class="form-control form-control-lg" id="mypostfile" name="myoldfile" accept="image/*" value="<?php echo $redit['filename']; ?>"type="hidden" > 
                        </div>
                       <button type="submit" class="btn btn-lg btn-primary btn-bloc" name="<?php echo !empty($_REQUEST['edit'])?'update':'submit'; ?>">Submit</button>
                        
                    </fieldset>
                </form>
                </div>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>
  
    
    <script src="js/plugins.js"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>
</body>
</html>