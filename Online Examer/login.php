<?php
	require('dbconnection.php');
	session_start();
    
    // If already logedin
	if(isset($_SESSION['isloggedin'])){
		if($_SESSION['isloggedin']==true){
			header('location:instruct.php');
            exit();
		}
	}

	$flag=0;
    
    // Login
	if(isset($_POST['loginBtn'])){
		$email=$_POST['lemail'];
		$pwd=$_POST['lpwd'];
		
        $query = "SELECT * FROM users WHERE email='$email' AND pwd='$pwd'";
		$result=mysqli_query($con,$query);
		
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				$_SESSION['isloggedin']=true;
				$_SESSION['email']=$row['email'];
			}
			header('location:instruct.php');
			exit();
		}else{
			$flag=1;
		}
	}

    // Singup
	if(isset($_POST['signupBtn'])){
		$email=$_POST['email'];
		$course=$_POST['course'];
		$semester=$_POST['semester'];
		$rollno=$_POST['rollno'];
		$contact=$_POST['contact'];
		$pwd=$_POST['pwd'];
        
        $query = "INSERT INTO users(email,rollno,course,sem,contact,pwd) VALUES('$email','$course','$semester','$rollno','$contact','$pwd')";
        $query2 = "INSERT INTO constants(email,istattempted) VALUES('$email','false')";
		if(mysqli_query($con,$query) && mysqli_query($con,$query2)){
			echo '<script>alert("Sign up successfull");</script>';// when sign up is successfull
		}else{
			$flag=2;
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log in</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
	<script type="text/javascript" src="bootstrap/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/popper.min.js"></script>
	<script type="text/javascript" src="bootstrap/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/custom_login_css.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="#">M180252CA</a>
        <ul class="navbar-nav mr-auto"></ul>
        <ul class="navbar-nav">
            <form class="form-inline" action="" method="POST"> <!-- LOGIN FORM -->
			    <div class="input-group mr-2 mb-2">
			      	<div class="input-group-prepend">
			        	<span class="input-group-text">@</span>
			      	</div>
			      	<input type="text" class="form-control" id="lemail" name="lemail" placeholder="Email" onkeyup="hideLError()">
			    </div>
			    <div class="input-group mr-2 mb-2">
			      	<div class="input-group-prepend">
			        	<span class="input-group-text">&nbsp;*&nbsp;</span>
			      	</div>
			      	<input type="Password" class="form-control" id="lpwd" name="lpwd" placeholder="Password" onkeyup="hideLError()">
			    </div>
			    <div class="input-group mr-2 mb-2">
			      	<input type="submit" class="btn btn-success" name="loginBtn" value="LOG IN" onclick="return loginValidation()">
			    </div>
			</form><!-- Login form ends here-->
        </ul>
        <small id="loginerror" class="form-hint text-danger">
      		username or password incorrect.
    	</small>
    </nav>
	<div class="row">
		<div class="col-lg-7 border bgSet">
		</div>
		<div class="col-lg-5 border p-2 p-sm-2 bgGradient">
			<div class="container-fluid p-lg-3">
				<h1 class="mt-lg-5 m-3">Sign Up</h1>
				<form action="" method="POST">
					<div class="form-group signupText">
				    	<label for="email">Email address:</label>
				    	<input type="email" class="form-control" id="email" name="email" onkeyup="hideNext(this)">
				    	<small id="emailerror" class="form-hint text-danger">
      						Email not valid
    					</small>
				  	</div>
				  	<div class="form-group signupText">
					  	<label for="course">Course:</label>
					  	<select class="form-control signupText" id="course" name="course" onchange="courseChange()">
					    	<option value="mca">MCA</option>
					    	<option value="bt">B.Tech</option>
					    	<option value="mt">M.Tech</option>
					  	</select>
					  	<small id="courseerror" class="form-hint text-danger">
      						Must be 8-20 characters long.
    					</small>
					</div>
					<div class="form-group signupText">
					  	<label for="semester">Semester:</label>
					  	<select class="form-control signupText" id="semester" name="semester">
					    	<option value="1">1</option>
					    	<option value="2">2</option>
					    	<option value="3">3</option>
					    	<option value="4">4</option>
					    	<option value="5">5</option>
					    	<option value="6">6</option>
					  	</select>
					  	<small id="semestererror" class="form-hint text-danger">
      						Must be 8-20 characters long.
    					</small>
					</div>
					<div class="form-group signupText">
				    	<label for="rollno">Roll No.:</label>
				    	<input type="text" class="form-control" id="rollno" name="rollno" onkeyup="hideNext(this)">
				    	<small id="rollerror" class="form-hint text-danger">
      						Must be 4-10 characters long.
    					</small>
				  	</div>
					<div class="form-group signupText">
				    	<label for="contact">Contact no:</label>
				    	<input type="text" class="form-control" id="contact" name="contact" onkeyup="hideNext(this)">
				    	<small id="contacterror" class="form-hint text-danger">
      						Must be 10 digit long.
    					</small>
				  	</div>
				  	<div class="form-group signupText">
				    	<label for="pwd">Password:</label>
				    	<input type="password" class="form-control" id="pwd" name="pwd" onkeyup="hideNext(this)">
				    	<small id="pwderror" class="form-hint text-danger">
      						Must be 8-20 characters long.
    					</small>
				  	</div>
				  	<div class="form-group signupText">
				    	<label for="cpwd">Confirm Password:</label>
				    	<input type="password" class="form-control" id="cpwd" name="cpwd" onkeyup="hideNext(this)">
				    	<small id="cpwderror" class="form-hint text-danger">
      						Password not Matching
    					</small>
				  	</div>
				  	<input type="submit" class="btn btn-primary" id="signupBtn" name="signupBtn" onclick="return signupValidation()" value="Sign Up"><small id="signuperror" class="form-hint text-danger">
      						Sign up not Successful (may be email id is already registered)
    					</small>
				</form>
			</div>
		</div>
	</div>

</body>
<script type="text/javascript" src="js/custom_login_js.js"></script>
</html>
<?php
	if($flag==1){
		echo '<script>loginerror.style.visibility="visible";</script>'; //this will display error
	}else if($flag==2){
		echo '<script>signuperror.style.visibility="visible";</script>'; //this will display error
	}
?>