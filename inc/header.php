<?php 
	$filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Session.php');
    Session::init();
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');

    spl_autoload_register(function($class) {
    	include_once 'classess/'.$class.'.php';
    });

    $db   = new Database();
    $fm   = new Format();
    $user = new User();
    $exam = new Exam();
    $pro  = new Process();
 ?>
<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); 
header("Pragma: no-cache"); 
header("Expires: Mon, 6 Dec 1977 00:00:00 GMT"); 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="uft-8">
	<title>Online Exam System</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-cache">
	<link rel="stylesheet" href="css/main.css">
	<script src="js/jquery.js"></script>
	<script src="js/main.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<?php 
	if (isset($_GET['action']) && $_GET['action'] == 'logout') {
		Session::destroy();
		header("Location: index.php");
		exit();
	}
?>
<body>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>                        
	      </button>
	      <a class="navbar-brand" href="index.php">Online Exam System</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav navbar-right">
	      	<?php 
	      		$login = Session::get("login");
	      		if ($login == true) {
	      	 ?>
	      	 <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
	      	 <li><a href="exam.php"><span class="glyphicon glyphicon-pencil"></span> Exam</a></li>
	      	 <li><a href="?action=logout"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
	      	 <?php } else { ?>
	        <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
	        <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	        <?php } ?>
	      </ul>
	    </div>
	  </div>
	</nav>
		