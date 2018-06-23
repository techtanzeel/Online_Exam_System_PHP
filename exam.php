<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	Session::checkSession();
 ?>

<div class="row">
	<div class="col-md-12 text-center">
		<h2>Welcome to Online Exam System</h2>
		<a href="starttest.php"><img src="img/start_test.jpg" heigth="180px" width="180px"></a>
	</div>
</div>
<?php include 'inc/footer.php'; ?>	