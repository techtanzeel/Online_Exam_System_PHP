<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classess/Exam.php');
	$exam = new Exam();
?>
<?php 
	if (isset($_GET['delques'])) {
		$quesNo = (int)$_GET['delques'];
		$delQus = $exam->delQuestion($quesNo);
	}
 ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Question List</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Question List</h1>
			</div>
		</div><!--/.row-->
		<?php 
			if (isset($delQus)) {
				?><div class="alert alert-danger"><?php echo $delQus;?></div><?php
			}
		 ?>
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-striped">
				<tr>
					<th>No</th>
					<th>Question</th>
					<th>Action</th>
				</tr>
				<?php 
					$getData = $exam->getQuesByOrder();
					if ($getData) {
						$i = 0;
						while ($result = $getData->fetch_assoc()) {
							$i++;
				 ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $result['ques']; ?></td>
					<td>
						<a onclick="return confirm('Are you sure to remove?');" href="?delques=<?php echo $result['quesNo']; ?>"><button class="btn btn-danger">Remove</button></a>
					</td>
				</tr>
				<?php } } else { ?>
					<tr><td colspan="5" style="text-align:center"><?php echo "<b>Question Not Available !</b>"; ?></td></tr>
				<?php } ?>
				</table>
			</div>
		</div><!--/.row-->
								
<?php include 'inc/footer.php'; ?>