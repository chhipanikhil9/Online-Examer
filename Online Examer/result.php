<?php
	require('dbconnection.php');
	require('start.php');

	$query="SELECT * FROM questions;";
	$result=mysqli_query($con,$query);
	$nos=mysqli_num_rows($result);
	$k=0;
	$ans=[];
	for($i=0;$i<$nos;$i++){
		if(isset($_POST['radio'.$i]))
			$ans[]=$_POST['radio'.$i];
		else
			$ans[]=null;
	}


	$query="SELECT * FROM questions;";
	$result=mysqli_query($con,$query);

	$rAttempt=0;
	$wAttempt=0;
	$nAttempt=0;


	$qno=1;
	$ques=[];
	$op1=[];
	$op2=[];
	$op3=[];
	$op4=[];
	$cor=[];
	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_assoc($result)){
			$ques[]=$row['ques'];
			$op1[]=$row['option1'];
			$op2[]=$row['option2'];
			$op3[]=$row['option3'];
			$op4[]=$row['option4'];
			$cor[]=$row['correct'];					  
			$qno++;
		}
	}

	$anstring='';
	for($i=0;$i<$nos;$i++){
		if($ans[$i]==null)
			$anstring.='0';		//0 for not attempt
		else if($ans[$i]==$cor[$i]){
			$anstring.='1';		//1 for right ans
		}else{
			$anstring.='2';		//2 for wrong ans
		}
	}

	$que='UPDATE user_test SET answers="'.$anstring.'" WHERE email="'.$_SESSION['email'].'";';
	if(mysqli_query($con,$que)){
	}else{
		echo 'error'.mysqli_error($con);
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Result</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
	<script type="text/javascript" src="bootstrap/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/popper.min.js"></script>
	<script type="text/javascript" src="bootstrap/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/custom_result_css.css">
</head>
<body>
	<?php
		require('navbar.html');
	?>
		<div class="jumbotron shadow-lg text-left bg-dark rounded-0 text-light">
			<h1>Result</h1>
			<p class="p-0 m-0">Total Questions: <span id="totalNo"><?php echo $nos; ?></span></p>
			<p class="p-0 m-0">Right attempt: <span id="rightNo"></span></p>
			<p class="p-0 m-0">Wrong attempt: <span id="wrongNo"></span></p>
			<p class="p-0 m-0">Not attempt: <span id="notNo"></span></p>
			<p class="p-0 m-0">Total Marks: <span id="totalMarks"></span></p>
		</div>
	<div class="container-fluid">
			<div class="row">
				<div class="col-md-2">
				</div>
				<div class="col-md-8 p-3 border shadow-lg">
					<button data-toggle="collapse" class="btn btn-secondary" data-target="#instr">Click here for Instruction</button>

					<div id="instr" class="collapse">
						<span class="empBox bg-success"></span> Right<br>
						<span class="empBox bg-danger"></span> Wrong<br>
						<span class="empBox bg-warning"></span> Not-attempted<br><br>
						<label class="rad-container"> Right answer
							  	<input type="radio" disabled checked>
							  	<span class="checkmark check-right"></span>
						</label>
						<label class="rad-container"> Wrong attempt
							  	<input type="radio" disabled checked>
							  	<span class="checkmark check-wrong"></span>
						</label>
					</div>
					<br>
					<br>
					<div class="allQues">

						<?php
							$pr='';
							for($i=0;$i<$nos;$i++){

								$pr.='<div class="curQues"><p class="ques p-2 ';
								if($ans[$i]==null){
									$pr.='bg-warning ';
									$nAttempt++;
								}else if($ans[$i]!=$cor[$i]){
									$pr.='bg-danger ';
									$wAttempt++;
								}else if($ans[$i]==$cor[$i]){
									$pr.='bg-success ';
									$rAttempt++;
								}
								$pr.='">Q'.($i+1).') '.$ques[$i].'</p>';
								$pr.='<label class="rad-container">'.$op1[$i];
								$pr.='<input type="radio" disabled checked><span class="checkmark ';
								if($cor[$i]==1){
									$pr.='check-right ';
								}else if($ans[$i]==1){
									$pr.='check-wrong ';
								}
								$pr.='"></span></label>';
								
								$pr.='<label class="rad-container">'.$op2[$i];
								$pr.='<input type="radio" disabled checked><span class="checkmark ';
								if($cor[$i]==2){
									$pr.='check-right ';
								}else if($ans[$i]==2){
									$pr.='check-wrong ';
								}
								$pr.='"></span></label>';
								
								$pr.='<label class="rad-container">'.$op3[$i];
								$pr.='<input type="radio" disabled checked><span class="checkmark ';
								if($cor[$i]==3){
									$pr.='check-right ';
								}else if($ans[$i]==3){
									$pr.='check-wrong ';
								}
								$pr.='"></span></label>';
								
								$pr.='<label class="rad-container">'.$op4[$i];
								$pr.='<input type="radio" disabled checked><span class="checkmark ';
								if($cor[$i]==4){
									$pr.='check-right ';
								}else if($ans[$i]==4){
									$pr.='check-wrong ';
								}
								$pr.='"></span></label></div>';
								
							}

							echo $pr;
						?>
					</div>
				</div>
				<div class="col-md-2">
				</div>
			</div>
	</div>
	<script type="text/javascript" src="js/custom_result_js.js"></script>
	<?php
		echo '<script>rn.innerHTML="'.$rAttempt.'"; wn.innerHTML="'.$wAttempt.'"; nn.innerHTML="'.$nAttempt.'";</script>';
		$marks=($rAttempt*4)-$wAttempt;
		echo '<script>tn.innerHTML="'.$marks.'";</script>';
	?>
</body>
</html>