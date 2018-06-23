<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
 ?>
 <div class="container">
 	 <?php 
 		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 			$name     = $_POST['name'];
 			$username = $_POST['username'];
 			$email    = $_POST['email'];
 			$password = $_POST['password'];
 			$userReg  = $user->userRegistration($name, $username, $email, $password); 
 			if (isset($userReg)) {
 				echo $userReg;
 			}
 		}
 	  ?>
 	<div class="row">
 		<div class="col-md-12">
 			<div class="panel panel-default">
 				<div class="panel panel-heading">
 					<h3>User Registration</h3>
 				</div>
 				<div class="panel-body">
 					<form action="" method="post">
 						<div class="form-group">
 							<label for="name">Full Name</label>
 							<input type="text" name="name" id="name" class="form-control" placeholder="Full Name">
 						</div>
 						<div class="form-group">
 							<label for="username">Username</label>
 							<input type="text" name="username" id="username" class="form-control" placeholder="Username">
 						</div>
 						<div class="form-group">
 							<label for="email">Email</label>
 							<input type="email" name="email" id="email" class="form-control" placeholder="Email">
 						</div>
 						<div class="form-group">
 							<label for="password">Password</label>
 							<input type="password" name="password" id="password" class="form-control" placeholder="Password">
 						</div>
 						<button type="submit" class="btn btn-success">Register</button>
 					</form>
 				</div>
 			</div>
 		</div>
 	</div>
 </div> 
<?php include 'inc/footer.php'; ?>	