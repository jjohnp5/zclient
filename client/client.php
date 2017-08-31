<?php
session_start();

if(array_key_exists('id', $_COOKIE)){
    $_SESSION['id'] = $_COOKIE['id'];
}
if(array_key_exists('id', $_SESSION)){
  include '../mysql/connections.php';
  $query = "SELECT * FROM `users` WHERE id = '".mysqli_real_escape_string($connect, $_SESSION['id'])."' LIMIT 1";
  $result = mysqli_query($connect, $query);
  $row = mysqli_fetch_array($result);


}else{
    header("Location: index.php");
}
if(array_key_exists('cid', $_GET)){
  include '../mysql/connections.php';
  $clientQuery = "SELECT * FROM `clients` WHERE cid='".mysqli_real_escape_string($connect, $_GET['cid'])."' LIMIT 1";
  $clientResult = mysqli_query($connect, $clientQuery);
  $clientRows = mysqli_fetch_array($clientResult);
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="style-client.css"/>
  </head>
<body style="padding-top: 75px;">
<div class="container-fluid">
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="../index.php">zClient</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="../index.php">Home  <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="../clients">Clients</a>
        </li>

      </ul>

      <ul class="navbar-nav navbar-right">
      <li class="nav-item">
        <a class="nav-link" href="../index.php?logout=1">Logout</a>
      </li>
    </ul>
    </div>
  </nav>
  <div class="row" style="padding-top: 5rem">
    <div class="col-xs-12 col-sm-4">
          <div class="thumbnail">
            <img class="img-thumbnail" src="../blankprofile.png" alt="profile_picture">
          </div>
    </div>
    <div class="col-xs-12 col-sm-4">
      <p>Client of: <?php echo (isset($row)&&$clientRows['uid']===$row['id']) ?  ucfirst($row['lname']).", ".ucfirst($row['fname']) : "No Owner Yet"; ?></p>
      <p>First name: <?php echo $clientRows['fname'];?></p>
      <p>Last name: <?php echo $clientRows['lname'];?></p>
      <p>Email: <?php echo $clientRows['email'];?></p>
      <p>Company: <?php echo ucfirst($clientRows['company']);?></p>
      <p>Position: <?php echo ucfirst($clientRows['position']);?></p>

    </div>
    <div class="col-xs-12 col-sm-4">
      <form method="post">
        <input type="button" class="btn btn-primary" value="Add Client" name="addclient">
      </form>
    </div>
  </div>
</div>

<script async src="client-page.js" charset="utf-8"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>
