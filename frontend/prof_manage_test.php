<!--
Kenneth Aparicio 
Front End
CS490

Prof -> Home -> [Manage Test] 
 -->

<?php
//show errors
include 'showerrors.php';

//start session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CS490 Prof Logged In</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  <script src="profscript.js"></script>
<ul>
  <li><a class="active" href="prof_home.php">Home</a></li>
  <li style="float:right"><a href="logout.php">LogOut</a></li>
</ul>
</head>


<?php
	//MID URL - get Test Names
	$url = "https://web.njit.edu/~or32/rc/receivealltests.php";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, true);
//	curl_setopt($ch, CURLOPT_POSTFIELDS, $DATA);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$tests = curl_exec($ch);
    curl_close($ch);
?>

<body>
<center>
	<h1>Welcome <?php echo ucfirst($_SESSION['p_ucid']) ?> </h1>
	
	<?php	
	//if session student ucid is set, it's true -> you are logged in
	if (isset($_SESSION['p_ucid'])) {
		//echo "You have successfully logged in Student!"; 
	}else {
		//redirects to kfront page ...if not logged in
		header("location: kfront.php");
	}
	?>

  <div id="wrapper">

    <div id="topbox">
    <h3>Edit a Test</h3>
    <button type="button" class="btn btn-hover btn-block btn-primary" onclick="showTestDiv()">Choose a Test to Edit</button>
    <h4>See Previous results</h4>
    <button type="button" class="btn btn-hover btn-block btn-green-primary" onclick="showGradeDiv()">See current grades</button>
 </div>

    <div id="availableTests" style="display:none;">
    
    <form method="post" action="/~ka279/cs490/rc/prof_edit_test.php"> 
    	<h3>List of Tests</h3>
       <?php
       foreach(json_decode($tests) as $test){
       	//echo $test;
       	//echo "<div style ='font:11px/21px Arial,tahoma,sans-serif;color:#ff0000'> $test</div>";
       	echo "<p>";
       	echo "<input type='radio' name=testList[]' value='$test'>"; //Test - radio button
       	echo "<font color=DarkBlue>$test</font>";
       	echo "</p>";
          }
       ?>         
        <br> 
       <input type="submit" class="btn btn-hover btn-block btn-orange-primary" name="selectedExam" value="Edit">
    </form>
     </div>


<body>
<center>




</center>
</body>
</html>