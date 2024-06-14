<?php
  include("../config/connection.php");
  session_start();

  $message="";
  $login = mysqli_real_escape_string($conn,$_POST["login"]);
  $password = mysqli_real_escape_string($conn,$_POST["password"]);
  
  try {

    $get_user = "
      SELECT 
        id,
        login,
        password,
        permission
      FROM 
        users 
      WHERE 
        login=?
    ";
    
    $stmt = mysqli_prepare($conn, $get_user);
    mysqli_stmt_bind_param($stmt,'s',$login);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if ($res->num_rows != 1) {
      echo 'Błąd';
      die;
    }

    $user = mysqli_fetch_array($res);

  }
  catch (Exception $e) {
    $message='Niewłaściwa nazwa użytkownika';
  }

 // $hash_password = $user["password"];

 // if (password_verify($password, $hash_password)) {
    if ($password) {

    try {

      $_SESSION["user_id"] = $user["id"];

      if ($user["permission"]=="3") {
        header('Location: client/client.php');
        //echo "przekierowanie na strone uzytkownika.<br>";
      }
      else if ($user["permission"]=="2") {
        header('Location: pracownik.php');
        //echo "przekierowanie na strone pracownika.<br>";
      }
      else if ($user["permission"]=="1") {
        header('Location: administrator.php');
        //echo "przekierowanie na strone administratora.<br>";
      }
      else {
      $message='Przekierowanie nie powiodło się.';
      }

    }
    catch (Exception $e) {
    $message='Bład wyszukiwarki lub logowania.';
    }

  }
  else {
    $message='Błąd podczas logowania.';
  }

?>
<script>
 if($message != "") {
    alert($message);
    header('Location: index.php');
  } 
</script>