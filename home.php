<?php
session_start();

if(array_key_exists('id', $_COOKIE)){
    $_SESSION['id'] = $_COOKIE['id'];
}
if(array_key_exists('id', $_SESSION)){
   include "./mysql/connections.php";
    $query = "SELECT * FROM `users` WHERE id = '".mysqli_real_escape_string($connect, $_SESSION['id'])."' LIMIT 1";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    $clientQuery = "SELECT * FROM `clients` WHERE uid = '".mysqli_real_escape_string($connect, $_SESSION['id'])."'";
    $clients = mysqli_query($connect, $clientQuery);


} else{
    header("Location: index.php");
}
if(array_key_exists("email", $_GET)){
    $email = "That email already exist in our system.";
} else{
  $email = "Client has been added successfully.";
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
      <a class="navbar-brand" href="index.php">zClient</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./clients">Clients</a>
          </li>

        </ul>
        <ul class="navbar-nav navbar-right">
        <li class="nav-item">
          <a class="nav-link" href="index.php?logout=1">Logout</a>
        </li>
      </ul>
      </div>
    </nav>

    <div class="jumbotron">
  <h1 class="display-3">Welcome, <?php echo $row['fname']?>!</h1>
  <p class="lead">Good day to check client profiles!</p>
  <hr class="my-4">
  <p class="lead">
    <a class="btn btn-lg" href="clients.php" role="button">Clients</a>
  </p>
</div>
<div class="row" style="padding-top: 5rem">
  <div class="col-xs-12 col-sm-4">
        <div class="thumbnail">
          <img class="img-thumbnail" src="blankprofile.png" alt="profile_picture">
          <div class="col-xs-12 col-sm-8">
            <p>Name: <?php echo $row['lname'].", ".$row['fname']; ?></p>
            <p>Email: <?php echo $row['email']?></p>

          </div>
        </div>
  </div>
  <div class="col-xs-12 col-sm-8">
    <h2>Clients</h2>
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <ul class='list-group'>
        <?php
        while($clientRows = mysqli_fetch_array($clients)){
            echo "<li class='list-group-item'><a href='./client/client.php?cid=".$clientRows['cid']."' >".ucfirst($clientRows['lname']).", ".ucfirst($clientRows['fname'])."</a></li>";
          }

        ?>
      </ul>
      </div>
      <div class="col-xs-12 col-sm-6">
        <?php
        if(isset($_GET['email']) && $_GET['email']=="true"){
          echo "<div class='alert alert-danger' role='alert'>".
            $email
            ."</div>";
        }else if(isset($_GET['email']) && $_GET['email']=="false"){
          echo "<div class='alert alert-success' role='alert'>".
            $email
            ."</div>";
        }
        ?>
        <input type="button" class="show btn" value="Add Clients">
        <a href="./clients" class="btn btn-primary">Search Clients</a>
        <form method="post" action="mysql/processadd.php" class="addForm clientForm" style="padding-top: 25px;">
          <div class="form-group">
              <input type="text" class="form-control" id="fname" placeholder="First" name="fname">
          </div>
          <div class="form-group">
              <input type="text" class="form-control" id="lname" placeholder="Last" name="lname">
          </div>
          <div class="form-group">
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="user@domain.com" name="email">
          </div>
          <div class="form-group">
              <input type="text" class="form-control" placeholder="Company" name="company">
          </div>
          <div class="form-group">
              <input type="text" class="form-control" placeholder="Position" name="position">
          </div>
          <div class="form-group">
          <input type="hidden" name="uid" value=<?php echo $row['id']?>>
        </div>
          <button type="submit" class="btn btn-primary btn-lg btn-block" name="signup" id="addClient">Add to Clients</button>
        </form>
      </div>
  </div>


</div>

  </div>
</div>
<script src="client-js.js" charset="utf-8"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>
