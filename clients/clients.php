<?php
session_start();

if(array_key_exists('id', $_COOKIE)){
    $_SESSION['id'] = $_COOKIE['id'];
}
if(array_key_exists('id', $_SESSION)){
  include 'mysql/connections.php';
  $query = "SELECT * FROM `users` WHERE id = '".mysqli_real_escape_string($connect, $_SESSION['id'])."' LIMIT 1";
  $result = mysqli_query($connect, $query);
  $row = mysqli_fetch_array($result);


}else{
    header("Location: index.php");
}
if(array_key_exists('cid', $_GET)){
  include 'mysql/connections.php';
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
    <!-- <link rel="stylesheet" href="style.css"/> -->
    <style>
    *, *:before, *:after {
      box-sizing: inherit;
    }
    input.search {
      position: relative;
      z-index: 2;
    }
    .suggestions {
      margin: 0;
      padding: 0;
      position: relative;
      /*perspective:20px;*/
    }
    .suggestions li {
      background:white;
      list-style: none;
      border-bottom: 1px solid #D8D8D8;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.14);
      margin:0;
      padding:20px;
      transition:background 0.2s;
      display:flex;
      justify-content:space-between;
      text-transform: capitalize;
    }
    .search{
      width: 100%;
    }
    </style>
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
          <li class="nav-item">
            <a class="nav-link" href="./">Home  <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="clients.php">Clients</a>
          </li>

        </ul>

        <ul class="navbar-nav navbar-right">
        <li class="nav-item">
          <a class="nav-link" href="index.php?logout=1">Logout</a>
        </li>
      </ul>
      </div>
    </nav>


<div class="row" style="padding-top: 5rem">
  <div class="col-xs-12 col-sm-4">
    <form class="my-2 my-lg-0">
      <input type="text" class="form-control mr-sm-2 search" placeholder="Client Name, Email">
      <div>
        <ul class="txtSearch list-group">

        </ul>
    </div>
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
