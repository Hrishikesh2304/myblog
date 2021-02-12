<?php 
session_start();
include('include/function.php');
include('include/database.php');
checklogin();
$user=$_SESSION['username'];
 if(!empty($_REQUEST['delete'])){
      $delete=mysqli_query($conn,"DELETE from post where id='".$_REQUEST['delete']."'");  
       $success="<p style='color:green;'>Post Deleted Successfully</p>";  
  }
 ?>

 <?php

 if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 3;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $total_pages_sql = "SELECT COUNT(*) FROM post";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

  
$result = mysqli_query($conn,"SELECT p.filename,p.id,p.description,c.type FROM  post as p join category as c on(p.filecat=c.id) where user='".$user."' ORDER BY p.id DESC LIMIT $offset, $no_of_records_per_page");
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

        <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
   <?Php include('include/navbar.php'); ?>
<style type="text/css">
    
    .card {
     width: 1000px; 
     left: 100px; 
}


</style>
    <div class="tm-hero d-flex justify-content-center align-items-center" >
        <form class="d-flex tm-search-form">
<h1>WELCOME <?php echo ucwords(strtoupper($user)); ?></h1>
        </form>
    </div>
             
            <hr>
             <div class="row mb-4">
            <h2 class="col-6 tm-text-primary">
               <a href="mypost.php"> <button class="btn btn-primary  mb-2 offset-6">+New Post</button></a> 
            </h2>
            <div >

<div class="error" style="margin-left:645px;font-size: x-large;">
                        <?php echo isset($success)?$success:''; ?>
                </div>
       <div class="container-fluid bg-light py-6">
    <div class="row">
        <div class="col-md-8 mx-auto">
                <div class="card card-body">


                <table class="table table-bordered " id="mytable" style="width:100%;">
                  <thead>
                    <tr>
                      <th scope="col" style="background-color:#009999;">#</th>
                      <th scope="col" style="background-color:#009999;">Post</th>
                      <th scope="col" style="background-color:#009999;">Remark</th>
                      <th scope="col" style="background-color:#009999;">Type</th>
                      <th scope="col" style="background-color:#009999;">Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                       <?php 
                        $sr=1;
                        while($res=mysqli_fetch_assoc($result)){
                        ?>
                      <th scope="row"><?php echo $sr++; ?></th>
       
                      <td>

                     

                    <img src='mypost/<?php echo $res['filename']; ?>' style='height:100px;width:100px;'><br>

                </td>
                    <td><?php echo $res['description']; ?></td>
                       <td><?php echo $res['type']; ?></td>
                      <td><a href="mypost.php?edit=<?php echo $res['id'] ?>" >edit</a>|
                        <a href="?delete=<?php echo $res['id'] ?>" >delete</a></td>

                       </tr>
                  <?php } ?>
                   
                    
                  </tbody>
                </table>

 <ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>


                </div>
            </div>
        </div>
    </div>

    
       
<?php include('include/footer.php'); ?>
  
    
    <script src="js/plugins.js"></script>
     <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>

   
</body>
</html>