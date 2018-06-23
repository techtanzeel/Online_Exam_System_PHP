<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	Session::checkLogin();
 ?>
<div class="container">
	<?php 
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$email    = $_POST['email'];
			$password = $_POST['password'];
			$userlogin  = $user->userLogin($email, $password); 
			if (isset($userlogin)) {
				echo $userlogin;
			}
		}
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel panel-heading">
					<h3>User Login</h3>
				</div>
				<div class="panel-body">
					<form action="" method="post">
						<div class="form-group">
							<label for="email">Email Address</label>
							<input type="email" name="email" id="email" class="form-control" placeholder="Email Address">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Password">
						</div>
						<button type="submit" name="submit" class="btn btn-primary">Login</button> <span>Not Have An Account? <a href="register.php">Register Now</a></span>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>	