<?php
session_start();
$error = "";
if(array_key_exists("logout", $_GET)){
    unset($_SESSION['id']);
    setcookie("id", "", time() - 60*60);
    $_COOKIE["id"] = "";
} else if((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR
    (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])){
    header("Location: home.php");
}


if(array_key_exists("signup", $_POST)){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    include './mysql/connections.php';

    if(!$_POST['email']){
        $error .= "An email address is required";
    }
    if(!$_POST['password']){
        $error .= "A password is required";
    }
    if($error != ""){
        $error = "<p>There are error(s) in your form:</p>".$error;
    }else{
        $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($connect, $email)."' LIMIT 1";
        $result = mysqli_query($connect, $query);
        if(mysqli_num_rows($result) > 0){
            $error = "That email address is taken.";
        }else{
            $query = "INSERT INTO `users` (`fname`, `lname`, `email`, `password`) VALUES ('".mysqli_real_escape_string($connect, $fname)."', '".mysqli_real_escape_string($connect, $lname)."', '".mysqli_real_escape_string($connect, $email)."', '".mysqli_real_escape_string($connect, $password)."')";
            if(!mysqli_query($connect, $query)){
                $error = "<p>Could not sign you up, try again later.</p>";
            }else{
                $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($connect)).$password)."' WHERE id = ".mysqli_insert_id($connect)." LIMIT 1";
                $_SESSION['id'] = mysqli_insert_id($connect);
                mysqli_query($connect, $query); 
                if($_POST['stayLoggedIn'] == '1'){
                    setcookie("id", mysqli_insert_id($connect), time() + 60*60*24*365);
                }

            }
            header("Location: home.php");
        }
    }

}elseif(array_key_exists("login", $_POST)){
    $email = $_POST['email'];
    $password = $_POST['password'];
    include "./mysql/connections.php";
    $query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($connect, $email)."'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    if(isset($row)){
        $hashedPassword = md5(md5($row['id']).$password);
        if($hashedPassword == $row['password']){
            $_SESSION['id'] = $row['id'];
            if($_POST['stayLoggedIn'] == '1'){
                setcookie("id", $row['id'], time() + 60*60*24*365);
            }
            header("Location: home.php");
        }else{
            $error = "The E-mail/Password combination is not found.";
        }
    }else{
        $error = "The E-mail/Password combination is not found.";
    }
}



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link async rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link async rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="background">
    </div>
       <div class="container">
         <h1>Diary App</h1>
<?php
echo "<div id='error'>$error</div>";
   ?>

<div class="text-center container">
  <h4 class="header text-center">Interested?</h4><input type="button" class="auth btn btn-success" data-toggle=1 value="Proceed"/>


       <div class="login-form forms" data-form="signup">
           <form method="post">
               <div class="form-group">
                   <input type="text" class="form-control" id="fname" placeholder="First" name="fname">
               </div>
               <div class="form-group">
                   <input type="text" class="form-control" id="lname" placeholder="Last" name="lname">
               </div>
               <div class="form-group">
                   <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="user@domain.com" name="email">
                   <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
               </div>
               <div class="form-group">
                   <input type="password" class="form-control" id="password" placeholder="password" name="password">
               </div>
               <div class="form-check">
                   <label class="form-check-label">
                       <input type="checkbox" class="form-check-input" name="stayLoggedIn" value=1>
                       Remember me
                   </label>
               </div>
               <button type="submit" class="btn btn-primary btn-lg btn-block" name="signup">Sign Up and Log me in!</button>
           </form>

   </div>
   <div data-form="login" class="login-form forms">
           <form method="post">
               <div class="form-group">
                   <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                   <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
               </div>
               <div class="form-group">
                   <input type="password" class="form-control" id="password" placeholder="Password" name="password">
               </div>
               <div class="form-check">
                   <label class="form-check-label">
                       <input type="checkbox" class="form-check-input" name="stayLoggedIn" value=1>
                       Remember me
                   </label>
               </div>
               <button type="submit" class="btn btn-success btn-lg btn-block" name="login">Log In</button>
           </form>
         </div>

</div>
</div>

<!-- bootstrap js and self-written js -->
    <script async src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script async src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script async src="./script.js" type="text/javascript"></script>

</body>
</html>
