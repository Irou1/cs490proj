<!--
Kenneth Aparicio 
Front End
CS490

Prof -> Home -> Post Results -> Prof Get Student Test -> [Prof get student Test page]
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
   <title>CS490 Prof get Student Test Page</title>
   <link rel="stylesheet" type="text/css" href="style.css">
<ul>
  <li><a class="active" href="student_home.php">Home</a></li>
  <li style="float:right"><a href="logout.php">LogOut</a></li>
</ul>
</head>

<body>

<center>
<h1>Welcome <?php echo ucfirst($_SESSION['p_ucid']) ?> </h1> 
    <?php
      $student = $_GET['student'];  
      $_POST['sn'] = $student;
      $_SESSION['studentName'] = $student;
    ?>
<h2><?php echo $student; ?> POV</h2>
</center> 


<?php      
  	 $jsonData = array(
    //'flag' => 'login',
    'studentName' => $_POST['sn']
    );
    
    //MID URL
    //$url = "https://web.njit.edu/~or32/rc/receivetakentests.php";
    $url = "https://web.njit.edu/~em244/CS490/getTakenTests.php";

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
    
    //echo gettype ( $result );   //get var type 

    $testz = json_decode($result, 1); //json decode

    //display resultz - json array
    print('<pre>');
    print_r ($testz);
    print('</pre>');
    
   ?>

  <script type="text/javascript">
  function showStudentTestDiv(){
     document.getElementById('studentTestDivSpace').style.display = "block";
  } 
  </script>

  <center>

  <br>

  <?php //-------------------------------Testing-----------------------------------------?>

  <div id="wrapper">

    <div id="topbox">
    <button type="button" class="btn btn-hover btn-block btn-primary" onclick="showStudentTestDiv()">Show Tests</button>
  </div>

    <div id="studentTestDivSpace" style="display:none;">
    
    <form method="post" action="prof_publish_test_score.php"> 
        <h3>List of Tests which <?php echo $student ?> took</h3>
       <?php
       foreach($testz["exam"] as $testNamez){

        echo "<p>";
        echo "<input type='radio' name=testNameList[]' value='$testNamez'>"; //Test - radio button
        echo "<font color=DarkBlue>$testNamez</font>";
        echo "</p>";
          }
       ?>         
        <br> 
       <input type="submit" class="btn btn-hover btn-block btn-orange-primary" name="selectedStudentTest" value="Publish Student Test">
    </form>
 </div>
  

  </center>
   </body>
</html>
