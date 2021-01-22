<?php
	require('dbconnection.php');

	require('start.php');

	$que='SELECT * FROM user_test WHERE email="'.$_SESSION['email'].'"';
	$result=mysqli_query($con,$que);

	$curtime=time();
	$minrem=10;
	$secrem=0;
	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_assoc($result)){
			$t=strtotime($row['strt']);
            // If already attempted
			if($row['answers']!=null){
				header('location:aresult.php');
				exit();
			}
            
            // Remaning time
			$diff=$curtime-$t;
            
			if(intdiv($diff,60)>9){
				header('location:aresult.php');
				exit();
			}else{
				$minrem=9-intdiv($diff,60);
				$secrem=59-$diff%60;
			}
		}
	}else{
		$que='INSERT INTO user_test(email,strt) VALUES("'.$_SESSION['email'].'","'.date('Y-m-d H:i:s',$curtime).'")';
		mysqli_query($con,$que);
	}

	$query="SELECT * FROM questions;";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
	<script type="text/javascript" src="bootstrap/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/popper.min.js"></script>
	<script type="text/javascript" src="bootstrap/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/custom_script.css">
</head>
<body>
	<?php
		require('navbar.html');
	?>
		<div class="jumbotron shadow-lg text-left bg-dark rounded-0 text-light">
			<h1>Test</h1>
			<p>Answer questions</p>
		</div>
	<div class="container-fluid">
		<form action="result.php" method="POST">
			<div class="d-flex m-3">
	    		<div class="p-2 mr-auto">
	    			<span class="empBox bg-warning"></span> Not-attempted<br>
	    			<span class="empBox bg-success"></span> Attempted<br>
	    			<span class="empBox bg-info"></span> Not seen
	    		</div>
	    		<div class="p-2 text-right">Time remaining:<br> <span id="timer-min">
                    <?php echo $minrem ?></span>:<span id="timer-sec"><?php echo $secrem ?>
                    </span> 
                </div>
	  		</div>
			<div class="row shadow">
				<div class="col-md-4 p-3 border">
					<p>there will be option</p>
					<div class="m-sm-0 m-md-0 m-lg-4">
							<?php
								$result=mysqli_query($con,$query);
								$qno=1;
								$pr='<div class="btn-group m-1">';
								if(mysqli_num_rows($result)>0){
								while($row=mysqli_fetch_assoc($result)){
									$pr.='<button type="button" onclick="qBtnClick('.($qno-1).')" class="btn btn-q btn-info">'.$qno.'</button>';
									if($qno%5==0){
										$pr.='</div><br><div class="btn-group m-1">';
									}
									$qno++;
								}
							}
							$pr.='</div>';
							echo $pr;
							?>
				  	</div>
				</div>
				<div class="col-md-8 p-3 border">
					<div class="allQues">
						<?php
							$result=mysqli_query($con,$query);
							$qno=1;
							$pr='';
							// echo 'php running';
							if(mysqli_num_rows($result)>0){
								while($row=mysqli_fetch_assoc($result)){
									$pr.='<div class="curQues">
							<p class="ques">Q.'.$qno.')'.$row['ques'].'</p>
						    <label class="rad-container">'.$row['option1'].'
							  	<input type="radio" onclick="radioClick('.($qno-1).')" value="1" name="radio'.($qno-1).'">
							  	<span class="checkmark"></span>
							</label>
							<label class="rad-container">'.$row['option2'].'
								<input type="radio" onclick="radioClick('.($qno-1).')" value="2" name="radio'.($qno-1).'">
								<span class="checkmark"></span>
							</label>
							<label class="rad-container">'.$row['option3'].'
							  	<input type="radio" onclick="radioClick('.($qno-1).')" value="3" name="radio'.($qno-1).'">
							  	<span class="checkmark"></span>
							</label>
							<label class="rad-container">'.$row['option4'].'
							  	<input type="radio" onclick="radioClick('.($qno-1).')" value="4" name="radio'.($qno-1).'">
							  	<span class="checkmark"></span>
							</label>
						</div>';
									$qno++;
								}
							}

							echo $pr;
						?>


					</div>
					<div class="btn-group m-1 ml-5">
				    	<button type="button" id="prevBtn" onclick="npbtn('prev')" class="btn btn-primary">Previous</button>
				    	<button type="button" id="nextBtn" onclick="npbtn('next')" class="btn btn-primary">Next</button>
				    </div>
				</div>
			</div>

				<div class="d-flex justify-content-center mt-4">
				    <button type="button" class="btn btn-success shadow-lg" data-toggle="modal" data-target="#confirmSubmit">Submit</button>
				</div>
			<div class="modal" id="confirmSubmit">
			    <div class="modal-dialog">
			    	<div class="modal-content">
			      
				        <!-- Modal Header -->
				        <div class="modal-header">
					        <h4 class="modal-title">Are you Confirm?</h4>
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        </div>
				        
				        <!-- Modal body -->
				        <div class="modal-body">
				          Press 'Yes' for Submit<br>
				          Press 'No' for Cancel
				        </div>
				        
				        <!-- Modal footer -->
				        <div class="modal-footer">
				        	<input type="submit" class="btn btn-success" name="submitBtn" id="subBtn" value="Yes">
				        	<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
				        </div>
			      </div>
			    </div>
			</div>
		</form>
	</div>
	<script type="text/javascript" src="js/custom_test_js.js"></script>
</body>
</html>