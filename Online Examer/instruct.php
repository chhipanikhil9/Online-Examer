<?php
	require('start.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Instruction</title>
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
			<h1>Instructions: </h1>
			<p class="p-0 m-0">Read following Instruction carefully. <span id="totalNo"></span></p>
		</div>
	<div class="container-fluid">
			<div id="newuserSection" class="row">
				<div class="d-flex justify-content-center mt-4">
                    <div class="col-md-8 p-5 border shadow-lg">
                        <h1>Instructions:</h1>
                        <div class="p-2 ml-3">
                            <p>4 marks for correct answer</p>
                            <p>-1 marks for incorrect answer</p>
                            <p>0 marks for not attempting</p>
                            <span class="empBox bg-warning"></span> Not-attempted<br>
                            <span class="empBox bg-success"></span> Attempted<br>
                            <span class="empBox bg-info"></span> Not seen
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <a href="test.php">
                                <button type="button" class="btn btn-primary shadow-lg">Agree and Proceed</button>
                            </a>
                        </div>
                    </div>
			     </div>
			</div>
			<div id="cantattemptSection" class="row">
				<div class="d-flex justify-content-center mt-4">
                    <div class="col-md-8 p-5 border shadow-lg">
                        <h1>Instructions:</h1>
                        <div class="p-2 ml-3">
                            <p>You have already attempted this Test</p>
                            <p>Your result will be displayed here</p>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <a href="./test.php">
                                <button type="button" class="btn btn-primary shadow-lg">See Result</button>
                            </a>
                        </div>
                    </div>
			    </div>
			</div>
	</div>
	<script src="js/custom_instruct_js.js" type="text/javascript"></script>
</body>
</html>
<?php

	require('dbconnection.php');

    $query = 'SELECT * FROM constants WHERE email = "'.$_SESSION['email'].'"';
//	$query='SELECT * FROM constants WHERE email="'.$_SESSION['email'].'";';
	$result=mysqli_query($con,$query);
	
	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_assoc($result)){
			if($row['istattempted']=='true'){
				echo '<script>newusersection.style.display="none";cantattemptsection.style.display="block";</script>';
			}else{
				echo '<script>newusersection.style.display="block";cantattemptsection.style.display="none";</script>';
			}
		}
	}

?>