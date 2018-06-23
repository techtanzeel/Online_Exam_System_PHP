<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	Session::checkSession();
 ?>
<?php 
	if (isset($_GET['q'])) {
		$number = (int)$_GET['q'];
	} else {
		header("Location:exam.php");
	}
	$total    = $exam->getTotalRows();
	$Question = $exam->getQuestionByNumber($number);
 ?>
<div class="row">
	<div class="col-md-12 text-center">
		<h2>Question <?php echo $Question['quesNo']; ?> of <?php echo $total; ?></h2>
	</div>	
</div>		
 <?php 
 	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 		$process = $pro->processData($_POST);
 	}
  ?>
<div class="container">
	<div class="row">
		<div class="test">
			<form method="post" action="">
			<table> 
				<tr>
					<td colspan="2">
					 <h3>Ques <?php echo $Question['quesNo']; ?>: <?php echo $Question['ques']; ?></h3>
					</td>
				</tr>
				<?php 
					$answer = $exam->getAnswer($number);
					if ($answer) {
						while ($result = $answer->fetch_assoc()) {
				 ?>
				<tr>
					<td>
					 <input type="radio" name="ans" value="<?php echo $result['id']; ?>"/> <?php echo $result['ans']; ?>
					</td>
				</tr>
				<?php } } ?>

				<tr>
				  <td>
				  	<button type="submit" class="btn btn-success">Next Question</button>
					<input type="hidden" name="number" value="<?php echo $number; ?>"/>
				</td>
				</tr>
			</table>
		</form>
		</div>	
	</div>
	<br/>
</div>
<?php include 'inc/footer.php'; ?>



