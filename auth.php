<?php
if ( isset($_GET['delog'])) :
  session_start();
  unset($_SESSION['user']);
  unset($_SESSION['token']);
  header("location:auth.php");
  exit;
endif;

require 'config.php';
 if( isset($_POST['ident'])) :
  $sql = sprintf("SELECT * FROM users WHERE login = '%s' AND password= '%s' ",
  $_POST['login'],
  $_POST['password']
 );
$result = $connect->query($sql);
echo $connect->error;
if ($result->num_rows > 0) :
  $user = $result -> fetch_assoc();
  session_start();
  $_SESSION['user'] = $user['id_users'];
  $_SESSION['token'] = md5($user['login'].$user['id_users'].time());
  header("location:secure.php");
  exit;
  // myPrint_r($_SESSION);
  echo 'ok';
else:
  echo 'pas ok';
 endif;
endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="post">
    <input type="text" name="login">
    <input type="password" name="password" placeholder="Votre mot de passe">
    <input type="hidden" name="ident">
    <button>identitfy</button> 
</body>
</html>