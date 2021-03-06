<!--
Kenneth Aparicio 
Front End
CS490

Prof - Home Page
 -->

<?php
//show errors
include 'showerrors.php';

//start session
session_start();
include 'profSession.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CS490 Prof Logged In</title>
	<link rel="stylesheet" type="text/css" href="style.css">

<ul>
  <li><a class="active" href="prof_home.php">Home</a></li>
  <li style="float:right"><a href="logout.php">LogOut</a></li>
</ul>

</head>


<body>
<?php
	if (isset($_GET['BURN'])) { //display test deleted when activated
		burnFunction(); //run php delete test function
		$_SESSION['message'] = "Test successfully deleted!";
		echo "<div id='error_msg'>".$_SESSION['message']."</div>";
		unset($_SESSION['message']);
	}
?>
<center>
	<font color="white" size="6" face="verdana">Welcome <?php echo ucfirst($_SESSION['p_ucid']) ?> </font><br>
	<!-- <h1>Welcome <?php echo ucfirst($_SESSION['p_ucid']) ?> </h1> -->

<form>
	<br>
	<input type="button" value="Create Questions" class="btn btn-hover btn-block btn-primary" onclick="window.location.href='prof_qbank.php'" />
	<input type="button" value="Create Test" class="btn btn-hover btn-block btn-primary" onclick="window.location.href='prof_create_test.php'" />
	<input type="button" value="Manage Tests" class="btn btn-hover btn-block btn-primary" onclick="window.location.href='prof_manage_test.php'" />
	<br></br>
	<input type="button" value="Grade Test" class="btn btn-hover btn-block btn-green-primary" onclick="window.location.href='prof_grade_test.php'" />
	<input type="button" value="Publish Scores" class="btn btn-hover btn-block btn-green-primary" onclick="window.location.href='prof_post_results.php'" />
</form>

<?php
  function burnFunction() {
    //echo 'Run php function!';

    	//JSON data
	$jsonData = array(
	'flag' => 'test',
	'mode' => 'burn'
	);
	
	//MID URL
      
	//$url = "https://web.njit.edu/~or32/xr/midcontrol.php";
	$url = "http://afsaccess2.njit.edu/~or32/xr/deletetest.php";
	
	//initiate cURL
	$ch = curl_init($url);
	
	//Tell cURL that we want to send a POST request
	curl_setopt($ch, CURLOPT_POST, true);
	
	//Attach our encoded JSON string to the POST fields
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
	
	//returns $url stuff
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	 //Execute the request
	$result = curl_exec($ch);
	
	//close cURL 
	curl_close($ch);
  }
?>
<br><br>

</center>
</body>
</html>
