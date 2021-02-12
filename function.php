<?Php 
function check(){
	if(isset($_SESSION['success'])){
		return true;
	}

}

function checklogin(){
	if(!isset($_SESSION['success'])){
		session_destroy();
		header('Location:login.php');
	}
}

?>