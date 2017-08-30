<?php
$res = "";
if(array_key_exists('q', $_REQUEST)){
  include 'connections.php';
  $q = $_REQUEST["q"];
  $ajaxQuery = "SELECT * FROM `clients` WHERE fname LIKE '%".mysqli_real_escape_string($connect, $q)."%' OR lname LIKE '%".mysqli_real_escape_string($connect, $q)."%' OR email LIKE '%".mysqli_real_escape_string($connect, $q)."%'";
  $ajaxResult = mysqli_query($connect, $ajaxQuery);
  while($ajaxRow = mysqli_fetch_array($ajaxResult)){
    $res .= "<li class='list-group-item'><a href='client.php?cid=".$ajaxRow['cid']."'>".$ajaxRow['lname'].", ".$ajaxRow['fname']."</a></li>";
  }
}
echo $res === "" ? "No valid matches." : $res;
?>
