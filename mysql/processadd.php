<?php


  if(array_key_exists('uid', $_POST)){
    include "connections.php";
    $check = "SELECT * FROM `clients` WHERE email = '".mysqli_real_escape_string($connect, $_POST['email'])."' LIMIT 1";
    $checkQuery = mysqli_query($connect, $check);
    $row = mysqli_fetch_array($checkQuery);
    if(isset($row)){
      header("Location: home.php?email=true");
    }else{
      $query1 = "INSERT INTO `clients`(`uid`, `fname`, `lname`, `email`, `company`, `position`) VALUES ('";
      $query2 = mysqli_real_escape_string($connect, $_POST['uid'])."','".mysqli_real_escape_string($connect, $_POST['fname'])."','".mysqli_real_escape_string($connect, $_POST['lname'])."','".mysqli_real_escape_string($connect, $_POST['email'])."','".mysqli_real_escape_string($connect, $_POST['company'])."','".mysqli_real_escape_string($connect, $_POST['position'])."')";
      $query = $query1.$query2;
      if($result = mysqli_query($connect, $query)){
        header('Location: ../home.php');
      }else{
        echo $connect->error;
      }
    }

    }

?>
