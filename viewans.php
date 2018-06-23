<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	Session::checkSession();
	$total    = $exam->getTotalRows();
 ?>

<div class="row">
	<div class="col-md-12 text-center">
		<h2>All Question & Answer of : <?php echo $total; ?></h2>
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
			<table> 
				<?php 
					$getQues = $exam->getQuesByOrder();
					if ($getQues) {
						while ($Question = $getQues->fetch_assoc()) {
				 ?>
				<tr>
					<td colspan="2">
					 <h3>Ques <?php echo $Question['quesNo']; ?>: <?php echo $Question['ques']; ?></h3>
					</td>
				</tr>
				<?php 
					$number = $Question['quesNo'];
					$answer = $exam->getAnswer($number);
					if ($answer) {
						while ($result = $answer->fetch_assoc()) {
				 ?>
				<tr>
					<td>
					 <input type="radio"/> 
					 <?php 
					 	if ($result['rightAns'] == '1') {		
						 	echo "<span style='color:green;font-weight:bold'>".$result['ans']."</span>"; 
					 	} else {
					 		echo $result['ans'];
					 	}
					 ?>
					</td>
				</tr>
				<?php } } ?>

				<?php } } ?>
			</table>
		</div>	
	</div>
	<br/>
</div>
<?php include 'inc/footer.php'; ?>



