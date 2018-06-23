<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	Session::checkSession();
	$userId = Session::get("userId");
 ?>
 <div class="container">
 	<?php 
 		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 			$updateUser = $user->updateUserData($userId, $_POST);
 			if (isset($updateUser)) {
 				echo $updateUser;
 			}
 		}	
 	 ?>
 	<?php 
 		$getData = $user->getUserData($userId);
 		if ($getData) {
 			$result = $getData->fetch_assoc();
 	 ?>
 	<div class="row">
 		<div class="col-md-12">
 			<div class="panel panel-default">
 				<div class="panel panel-heading">
 					<h2>Your Profile</h2>
 				</div>
 				<div class="panel-body">
 					<form action="" method="post">
 						<div class="form-group">
 							<label for="name">Full Name</label>
 							<input type="text" name="name" id="name" class="form-control" value="<?php echo $result['name']; ?>">
 						</div>
 						<div class="form-group">
 							<label for="username">Username</label>
 							<input type="text" name="username" id="username" class="form-control" value="<?php echo $result['username']; ?>">
 						</div>
 						<div class="form-group">
 							<label for="email">Email</label>
 							<input type="email" name="email" id="email" class="form-control" value="<?php echo $result['email']; ?>">
 						</div>
 						<button type="submit" class="btn btn-success">Update</button>
 					</form>
 				</div>
 			</div>
 		</div>
 	</div>
 	<?php } ?>
 </div> 
<?php include 'inc/footer.php'; ?>	