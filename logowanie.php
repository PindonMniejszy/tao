<?php
ob_start();
ob_implicit_flush(0);
session_start();
if(@$_SESSION['zalogowany']==1)
{
    header('Location: index.php ');
}
include('db_fns.php');
@$login = $_POST['login'];
@$pass = sha1($_POST['password']);
$log = mysql_query("SELECT * FROM users WHERE login = '$login'") or die (mysql_error());
$logi = mysql_fetch_assoc($log);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Logowanie</title>
</head>

<body>
<div id="content">
    <h1 id="h1">Logowanie!</h1>

       <?php
        if(@$_POST['form']==true){
 if(@$login==@$logi['login'] && @$pass==@$logi['password'] && $logi['potwierdzenie']==1)
{
    $_SESSION['zalogowany']=1;
    $_SESSION['login']=$login;
    echo '<meta http-equiv="refresh" content="0;url=index.php" />';
    }
    elseif(@$login==@$logi['login'] && @$pass==@$logi['password'] && $logi['potwierdzenie']==0)
    {
         echo "<div id=\"blad\">";
       echo "Twoje konto nie zostało jeszcze aktywowane";
    echo "</div>";
    }
else{
       echo "<div id=\"blad\">";
       echo "Podałeś błędny login lub hasło";
    echo "</div>";
}
        }
    ?>
    <div id="logowanie">
    <form id="logowanie" name="logowanie" method="POST" action="logowanie.php" >
            Login: <input type="text" id="login" name="login" /><br />
            Hasło: <input type="password" id="password" name="password" /><br />
             <input type="hidden" name="form" id="form" value="true" />
            <input type="submit" value="&nbsp;&nbsp;Zaloguj!&nbsp;&nbsp;" />
        </form>

    </div>
    <br />
    Nie masz konta? <a href="rejestracja.php">Zarejestruj się!</a>
     <br />
    Nie pamiętasz hasła? <a href="lostpass.php">Przypomnij teraz!</a>
    </div>
</body>
</html>