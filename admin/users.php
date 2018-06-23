<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classess/User.php');
	$user = new User();
?>
<?php
  if (isset($_GET['dis'])) {
  	$dblid = (int)$_GET['dis'];
  	$dblUser = $user->disableUser($dblid);
  }

  if (isset($_GET['ena'])) {
  	$eblid = (int)$_GET['ena'];
  	$eblUser = $user->enableUser($eblid);
  }

   if (isset($_GET['del'])) {
  	$delid = (int)$_GET['del'];
  	$delUser = $user->deleteUser($delid);
  }
?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Manage User</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Manage User</h1>
			</div>
		</div><!--/.row-->
		<?php 
				if (isset($dblUser)) {
					?><div class="alert alert-warning"><?php echo $dblUser;?></div><?php
				} elseif(isset($eblUser)) {
					?><div class="alert alert-success"><?php echo $eblUser;?></div><?php
				} elseif(isset($delUser)) {
					?><div class="alert alert-danger"><?php echo $delUser;?></div><?php
				}	
		?>
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-striped table-bordered" id="mydata">
			<thead>		
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tfoot>		
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Actions</th>
				</tr>
			</tfoot>
			<?php 
				$userData = $user->getAllUser();
				if ($userData) {
					$i = 0;
					while ($result = $userData->fetch_assoc()) {
						$i++;
			 ?>
			 <tbody>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $result['name']; ?></td>
				<td><?php echo $result['username']; ?></td>
				<td><?php echo $result['email']; ?></td>
				<td>
					<?php if ($result['status'] == '0') { ?>
					<a onclick="return confirm('Are you sure to disable?');" href="?dis=<?php echo $result['userId']; ?>"><button class="btn btn-warning">Disable</button></a>
					<?php } else { ?>
					<a onclick="return confirm('Are you sure to enable?');" href="?ena=<?php echo $result['userId']; ?>"><button class="btn btn-success">Enable</button></a>
					<?php } ?>
					<a onclick="return confirm('Are you sure to remove?');" href="?del=<?php echo $result['userId']; ?>"><button class="btn btn-danger">Remove</button></a>
				</td>
			</tr>
			<tbody>
			<?php } } ?>
				</table>
			</div>
		</div><!--/.row-->
								
<?php include 'inc/footer.php'; ?>