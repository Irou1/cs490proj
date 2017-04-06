<!--
Kenneth Aparicio 
Front End
CS490

Student -> [Test Page] -> Actual Test Page 
 -->

 <?php
//start session
session_start();
 ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>CS490 Student Test Page Redirecting</title>
</head>

<body>

<?php

   //redirect to test page
   $selectedExam = $_POST['selectedExam'];
  
   if($selectedExam){ 
      header("Location: https://web.njit.edu/~ka279/cs490/rc/student_test_page.php?exam=$selectedExam");
      exit;
   }else{
      echo "Unable to Load test";
   }

?>

</body>
</html>