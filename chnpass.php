<?php
ob_start();
ob_implicit_flush(0);
session_start();
if(@$_SESSION['zalogowany']==0)
{
    header('Location: index.php ');
}
include('db_fns.php');
$pass=$_POST['pass'];
$pass2=$_POST['pass2'];
$sha1pass=sha1($pass);
@$login = $_SESSION['login'];
$log = mysql_query("SELECT * FROM users WHERE login = '$login'") or die (mysql_error());
$logi = mysql_fetch_assoc($log);
$old=$logi['password'];
$oldpas=$_POST['oldpass'];
$oldpass=sha1($oldpas);
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
    <h1 id="h1">Zmiana hasła!</h1>
 
       <?php
        if(@$_POST['form']==true){
 if($oldpass==$old&& $pass==$pass2 && $oldpass!=$pass)
{
    echo "<div id=\"ok\">";
//    session_unset();
//    session_destroy();
    $newpass=mysql_query("UPDATE users
SET password= '$sha1pass' WHERE login= '$login'");
    echo "Hasło zostało zmienione.";
    echo "<br />";
    echo "<a href=\"logowanie.php\">Zaloguj się ponownie</a>";
    echo "</div>";
    }
elseif($oldpass!=$old && $oldpass!="" && $pass!="" && $pass2!=""){
        echo "<div id=\"blad\">";
        echo "Podałeś błędne hasło";
        echo "<br />";
        echo "</div>";
}
elseif($pass!=$pass2 && $oldpass!="" && $pass!="" && $pass2!=""){
        echo "<div id=\"blad\">";
        echo "Podane hasła są różne";
        echo "<br />";
        echo "</div>";
}
elseif($oldpass==$pass && $oldpass!="" && $pass!="" && $pass2!=""){
        echo "<div id=\"blad\">";
        echo "Podane hasło nie może być takie, jak poprzednie";
        echo "<br />";
        echo "</div>";
}
elseif($pass=="" || $pass2=="" || $oldpass==""){
    echo "<div id=\"blad\">";
        echo "Musisz uzupełnić wszystkie pola";
        echo "<br />";
        echo "</div>";
}
        }
    ?>
    <div id="logowanie">
    <form id="chnpass" name="chnpass" method="POST" action="chnpass.php" >
            Stare hasło: <input type="password" id="oldpass" name="oldpass" /><br />
            Nowe hasło: <input type="password" id="pass" name="pass" /><br />
            Powtórz hasło: <input type="password" id="pass2" name="pass2" /><br />
             <input type="hidden" name="form" id="form" value="true" />
            <input type="submit" value="&nbsp;&nbsp;Zmień!&nbsp;&nbsp;" />
        </form>
 
    </div>
    <br />
    Wróć do <a href="index.php">strony głównej!</a>
    </div>
</body>
</html>