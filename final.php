<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	Session::checkSession();
 ?>

<div class="row">
	<div class="col-md-12 text-center">
		<h2>You are done !</h2>
		<h3>Congrats ! You have just completed the test.</h3>
		<h4>Final Score: <?php 
			if (isset($_SESSION['score'])) {
				echo $_SESSION['score'];
				unset($_SESSION['score']);
			}
		 ?></h4>
		<a href="viewans.php"><button class="btn btn-primary">View Answer</button></a>
		<a href="starttest.php"><button class="btn btn-info">Start Again</button></a>
		<br/><br/>
	</div>
</div>
<?php include 'inc/footer.php'; ?>	