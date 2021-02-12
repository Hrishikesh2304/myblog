<?php 
session_start();

	include 'include/database.php'; 
	include 'include/function.php';

	$page=@$_POST['page'];
	$category=@$_POST['category'];


    if(!empty($category)){

	$noofpost=mysqli_query($conn,"SELECT p.posteddate,p.filename,p.id,p.description,c.type FROM  post as p join category as c on(p.filecat=c.id) where p.filecat='".$category."' ");

	}else{

	$noofpost=mysqli_query($conn,"SELECT p.posteddate,p.filename,p.id,p.description,c.type FROM  post as p join category as c on(p.filecat=c.id)  ORDER BY p.id DESC");

	}

	if(isset($page)){
		$page=$page;
	}else{
		$page=0;
	}

    if(!empty($category)){

	$load=mysqli_query($conn,"SELECT p.posteddate,p.filename,p.id,p.description,c.type FROM  post as p join category as c on(p.filecat=c.id) where p.filecat='".$category."' limit $page,1");    	

    }else{
	$load=mysqli_query($conn,"SELECT p.posteddate,p.filename,p.id,p.description,c.type FROM  post as p join category as c on(p.filecat=c.id) limit $page,1");    	
    }

	while($res=mysqli_fetch_assoc($load)){

	$records="
              <div class='card mb-4 box-shadow'style='-webkit-box-shadow: 2px 2px 15px 2px #000000; box-shadow: 2px 2px 15px 2px #000000;margin-top: -79px;'>
                <img class='card-img-top' src='mypost/".$res['filename']."' alt='".$res['filename']."'' style='width:499px; height:200px;'>

                <div class='card-body'>
                  <p class='card-text'>".$res['description']."

              </p>
                  <div class='d-flex justify-content-between align-items-center'>
                    <div class='btn-group'>";






    $records .="         </div>
                    <small class='text-muted'>".date('d F Y',strtotime($res['posteddate']))."</small>
                  </div>

                  </div></div>

                  <br>
                 ";
               }
    $nextpage=$page+1;
    $previous=$page-1;
    $lastpoast=$noofpost->num_rows;
    $stop=$noofpost->num_rows-1;    
    $newpage=$page+1;
    if($page>0){
    $records .="


                 <span class='btn btn-primary' id='previouspage'  next=".$previous.">Previous</span>";

    }

    if($page<$stop){


    $records .="
                 <span class='btn btn-primary' style='float:right;' id='nextpage'  next=".$nextpage.">Next</span>
                 <br>
                 Showing ".$newpage." of :".$lastpoast."
               

		";


    } 



	echo $records;
?>
