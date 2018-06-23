<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	Session::checkSession();
	$question = $exam->getQueation();
	$total    = $exam->getTotalRows();
 ?>
<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<h2>Online Exam System</h2>
			<p>Number of question: <?php echo $total; ?></p>
			<p>Question type: Multiple Choice</p>
			<a href="test.php?q=<?php echo $question['quesNo']; ?>"><button class="btn btn-info">Start Test</button></a><br/><br/>
		</div>
	</div>
</div>

<?php include 'inc/footer.php'; ?>	