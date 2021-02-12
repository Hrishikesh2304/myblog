<?php 
session_start();
include('include/function.php');
include('include/database.php');
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

    <div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="img/hero.jpg">
        <form class="d-flex tm-search-form">

         
        </form>
    </div>
            <div class="container-fluid tm-container-content tm-mt-60">

                <div class="row mb-4">
          <label class="form-control tm-search-input">Select Categories</label>
          <div class="col-4 tm-text-primary">
           <select class="form-control " id="category">
            <option value=""> --Select Category--</option>
                <?php 
                              $query=mysqli_query($conn,"SELECT distinct id,type FROM category");

                              while($res=mysqli_fetch_assoc($query)){

                                echo "<option value='".$res['id']."'>".$res['type']."</option>";
                              }
                               ?>
            </select>
                
            </div>
        </div>


            </div>
            <hr>
    <div class="container-fluid tm-container-content tm-mt-60">

        <div class="row mb-4">
            <h2 class="col-6 tm-text-primary">
                Latest Photos
            </h2>
            <div class="col-6 d-flex justify-content-end align-items-center">
                
            </div>
        </div>

        <div class="col-md-5" id="mypost" style="margin:3% 30%;">

      </div>


            
            
          
<?php include('include/footer.php'); ?>
  
    
    <script src="js/plugins.js"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>

    <script>

     loadmypost();

      function loadmypost(data,category){
          mydata={
            'page':data,
            'category':category
          }
          $.ajax({
              type:'post',
              data:mydata,
              url:'ajax_pagination.php',
              success:function(data){
                $('#mypost').html(data);
              },error:function(){
                swal('Sorry Something went wrong');
              }
          });


      }
          
      $(document).on('change','#category',function(){
          var cat=$(this).val();
          if(cat!=''){
            loadmypost('0',cat);
          }
      });

      $(document).on('click','#nextpage',function(){
          var id=$(this).attr('next');  
          var category=$("#category").val();
        
          loadmypost(id,category);
        
      });

      $(document).on('click','#previouspage',function(){
          var id=$(this).attr('next');  
          var category=$("#category").val();

          loadmypost(id,category);
      });

    </script>
</body>
</html>