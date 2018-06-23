<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classess/Exam.php');
	$exam = new Exam();
?>
<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$addQues = $exam->addQuestion($_POST);
	}

	// Get Total Question No
	$total = $exam->getTotalRows();
	$next  = $total + 1;
 ?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Add Question</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Add Question</h1>
			</div>
		</div><!--/.row-->
		<?php 
			if (isset($addQues)) {
				?><div class="alert alert-success"><?php echo $addQues;?></div><?php
			}
 		?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<form action="" method="post">
							<div class="form-group">
								<label for="quesno">Question No.</label>
								<input type="number" name="quesNo" id="quesno" class="form-control" value="<?php if ($next) { echo $next; } ?>">
							</div>
							<div class="form-group">
								<label for="ques">Question</label>
								<input type="text" name="ques" id="ques" class="form-control" placeholder="Enter question" required>
							</div>
							<div class="row">
								<div class="col-lg-3">
									<div class="form-group">
										<label for="ans1">Choice 1</label>
										<input type="text" name="ans1" id="ans1" class="form-control" placeholder="Enter Choice 1" required>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="ans2">Choice 2</label>
										<input type="text" name="ans2" id="ans2" class="form-control" placeholder="Enter Choice 2" required>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="ans3">Choice 3</label>
										<input type="text" name="ans3" id="ans3" class="form-control" placeholder="Enter Choice 3" required>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<label for="ans4">Choice 4</label>
										<input type="text" name="ans4" id="ans4" class="form-control" placeholder="Enter Choice 4" required>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="rightAns">Correct Answer</label>
								<input type="number" name="rightAns" id="rightAns" class="form-control" placeholder="Enter Correct Answer" required>
							</div>
							<button type="submit" class="btn btn-success">Add Question</button>
						</form>
					</div>
				</div>
			</div>	
		</div><!--/.row-->
								
<?php include 'inc/footer.php'; ?>