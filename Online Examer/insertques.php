<!DOCTYPE html>
<html>
<head>
	<title>Insert Question</title>
</head>
<body>
	<form method="POST" action="">
		Question:
		<input type="text" name="q"><br>
		Option1:
		<input type="text" name="o1"><br>
		Option2:
		<input type="text" name="o2"><br>
		Option3:
		<input type="text" name="o3"><br>
		Option4:
		<input type="text" name="o4"><br>
		correct:
		<select name="a">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		</select>
		<input type="submit" name="qbtn">
	</form>
</body>
</html>
<?php

	require('dbconnection.php');
	if(isset($_POST['qbtn'])){
		$q=$_POST['q'];
		$o1=$_POST['o1'];
		$o2=$_POST['o2'];
		$o3=$_POST['o3'];
		$o4=$_POST['o4'];
		$a=$_POST['a'];

        $query = "INSERT INTO questions(ques,option1,option2,option3,option4,correct) VALUES('$q','$o1','$o2','$o3','$o4','$a')";

		if(mysqli_query($con,$query)){
			echo 'query executed';
		}else{
			echo 'error';
		}

	}
?>