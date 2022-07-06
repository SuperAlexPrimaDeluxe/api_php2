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
